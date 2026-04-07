<?php

namespace App\Modules\Vacancy\Console\Commands;

use App\Modules\Vacancy\Models\Vacancy;
use App\Modules\Vacancy\Models\VacancyValue;
use App\Modules\Vacancy\Support\HoursParser;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SyncVacancies extends Command
{
    protected const PAGE_SIZE = 10;

    protected const API_BASE = 'https://jobapi.otys.com/api/jobs';

    protected $signature = 'sync:vacancies';

    protected $description = 'Will sync all vacancies from the api provided.';

    protected array $vacancyProps = [
        'referenceNr', 'title', 'uid', 'entryDateTime', 'status',
        'user', 'userEmail', 'salaryCurrency', 'salaryValue',
        'salaryMin', 'salaryMax', 'salaryUnit', 'location',
        'locationAddress', 'locationCity', 'locationState',
        'locationCountry', 'locationCountryCode', 'relation',
        'relationContact', 'candidatesNeeded', 'published',
        'publicationStartDate', 'publicationEndDate',
        'publicationFirstDate', 'publicationStatus',
        'applyUrl', 'jobUrl',
    ];

    protected array $relevantKeys = [
        'language', 'slug', 'referenceNr', 'title', 'uid', 'status',
        'location', 'locationCity', 'locationState', 'locationCountry',
        'relation', 'candidatesNeeded', 'publicationStatus',
        'applyUrl', 'jobUrl',
        'hours_min', 'hours_max', 'hours_values',
    ];

    protected int $hoursParsed = 0;

    protected int $hoursUnparseable = 0;

    // @debug
    public function info($string, $verbosity = null)
    {
        Log::info(static::class . ' ' . $string);

        parent::info($string, $verbosity);
    }

    public function handle()
    {
        $startedAt = microtime(true);
        $this->info('Sync started at ' . now()->toDateTimeString());

        $this->runStep('all jobs', fn () => $this->syncAllJobs());
        $this->runStep('single job', fn () => $this->syncSingleJobs());

        $elapsed = round(microtime(true) - $startedAt, 1);
        $this->info("Sync finished in {$elapsed}s.");
    }

    protected function runStep(string $name, Closure $step): void
    {
        try {
            $step();
        } catch (Exception $e) {
            $this->error($e->getMessage());
            $this->info("Exception in {$name}: {$e}");
        }
    }

    protected function syncAllJobs(): void
    {
        $this->info('Fetching vacancies from OTYS...');

        $offset = 0;
        $page = 1;
        $allApiUids = [];
        $allRawUids = [];
        $droppedSamples = [];
        $this->hoursParsed = 0;
        $this->hoursUnparseable = 0;

        while (true) {
            [$rawData, $batch] = $this->fetchBatch($offset);
            $rawCount = $rawData->count();

            if ($rawCount === 0) {
                break;
            }

            $allRawUids = array_unique(array_merge($allRawUids, $rawData->pluck('uid')->all()));
            $this->collectDroppedSamples($rawData, $batch, $droppedSamples);

            if ($batch->isNotEmpty()) {
                $allApiUids = array_unique(array_merge($allApiUids, $this->processBatch($batch)));
            }

            $this->info(sprintf(
                '  page %d: %d fetched, %d kept after filter, %d total synced so far',
                $page,
                $rawCount,
                $batch->count(),
                count($allApiUids),
            ));

            if ($rawCount < self::PAGE_SIZE) {
                break;
            }

            $offset += self::PAGE_SIZE;
            $page++;
        }

        $this->info(sprintf('Synced %d vacancies across %d page(s).', count($allApiUids), $page));
        $this->reportFilterDiagnostic($allRawUids, $allApiUids, $droppedSamples);
        $this->reportHoursDiagnostic();
        $this->cleanupOldVacancies($allApiUids);
    }

    /**
     * Capture up to 5 unique sample structures of records dropped by the website filter.
     */
    protected function collectDroppedSamples(Collection $raw, Collection $kept, array &$samples): void
    {
        if (count($samples) >= 5) {
            return;
        }

        $keptUids = $kept->pluck('uid')->all();

        foreach ($raw as $item) {
            if (count($samples) >= 5) {
                break;
            }

            if (in_array($item['uid'], $keptUids, true) || isset($samples[$item['uid']])) {
                continue;
            }

            $samples[$item['uid']] = [
                'uid' => $item['uid'],
                'title' => $item['title'] ?? null,
                'publishedWebsites' => $item['publishedWebsites'] ?? null,
            ];
        }
    }

    protected function reportFilterDiagnostic(array $rawUids, array $keptUids, array $samples): void
    {
        $rawCount = count($rawUids);
        $keptCount = count($keptUids);
        $droppedCount = $rawCount - $keptCount;

        $this->info(sprintf(
            'Filter diagnostic: %d unique raw, %d kept, %d dropped (website_id=%s).',
            $rawCount,
            $keptCount,
            $droppedCount,
            (string) (config('vacancy.api.website_id') ?? 'none'),
        ));

        if ($droppedCount > 0 && ! empty($samples)) {
            $this->info('Sample dropped records (publishedWebsites structure):');
            foreach ($samples as $sample) {
                $this->info('  ' . json_encode($sample, JSON_UNESCAPED_UNICODE));
            }
        }
    }

    /**
     * @return array{0: Collection, 1: Collection} [raw response, filtered batch]
     */
    protected function fetchBatch(int $offset): array
    {
        $response = Http::withHeaders(['Ows-Api-Key' => config('vacancy.api.key')])
            ->accept('application/json')
            ->withQueryParameters([
                'language' => 'nl',
                'published' => true,
                'offset' => $offset,
            ])
            ->get(self::API_BASE);

        if (! $response->successful()) {
            throw new Exception('Something went wrong while syncing vacancies: ' . $response->body());
        }

        $data = collect($response->json());

        return [$data, $this->filterByWebsite($data)];
    }

    protected function filterByWebsite(Collection $data): Collection
    {
        $websiteId = config('vacancy.api.website_id');

        if (! $websiteId) {
            return $data;
        }

        return $data->filter(fn ($item) => isset($item['publishedWebsites'][(string) $websiteId]));
    }

    /**
     * @return array<int, string> UIDs of the vacancies in this batch
     */
    protected function processBatch(Collection $data): array
    {
        $vacancyData = $this->getVacancyResponse($data);

        $this->upsertVacancies($vacancyData);
        $vacancyData->each(fn ($item) => $this->finalizeSlug($item['vacancyData']));
        $this->upsertVacancyValues($vacancyData);

        return $vacancyData->pluck('vacancyData.uid')->toArray();
    }

    protected function upsertVacancies(Collection $vacancyData): void
    {
        $relevantData = $vacancyData->pluck('vacancyData')
            ->map(fn ($i) => collect($this->relevantKeys)
                ->mapWithKeys(fn ($k) => [$k => $i[$k] ?? null])
                ->all())
            ->toArray();

        Vacancy::upsert($relevantData, ['uid']);
    }

    protected function upsertVacancyValues(Collection $vacancyData): void
    {
        $combined = collect($this->getHeadingsBasedOnType($vacancyData, 'criteria'))
            ->concat($this->getHeadingsBasedOnType($vacancyData, 'textFieldTitles'))
            ->concat($this->getBodyFields($vacancyData, 'criteriaFields'))
            ->concat($this->getBodyFields($vacancyData, 'textFields'))
            ->sortBy('vacancy_id')
            ->values()
            ->all();

        VacancyValue::upsert($combined, ['unique_key', 'key', 'vacancy_id']);
        $this->cleanupStaleValues($combined);
    }

    protected function cleanupStaleValues(array $combined): void
    {
        $vacancyIds = collect($combined)->pluck('vacancy_id')->unique();
        $vacancies = Vacancy::whereIn('id', $vacancyIds)->get();

        foreach ($vacancies as $vacancy) {
            $vacancy->vacancyValues
                ->filter(fn ($value) => collect($combined)
                    ->where('vacancy_id', $vacancy->id)
                    ->where('unique_key', $value->unique_key)
                    ->where('key', $value->key)
                    ->isEmpty())
                ->each
                ->delete();
        }
    }

    private function finalizeSlug(array $vacancyData): void
    {
        $duplicate = Vacancy::where('slug', $vacancyData['slug'])
            ->where('uid', '!=', $vacancyData['uid'])
            ->exists();

        if (! $duplicate) {
            return;
        }

        $vacancy = Vacancy::where('uid', $vacancyData['uid'])->first();
        $vacancy->slug = Str::slug($vacancyData['title']) . '-' . $vacancy->id;
        $vacancy->save();
    }

    protected function cleanupOldVacancies(array $allApiUids): void
    {
        if (empty($allApiUids)) {
            Log::warning('Skipping cleanup: No UIDs returned from API. Potential issue with the API response.');
            return;
        }

        $vacanciesToDelete = Vacancy::whereNotIn('uid', $allApiUids)->get();

        if ($vacanciesToDelete->isEmpty()) {
            $this->info('Cleanup: nothing stale to remove.');
            return;
        }

        $this->info(sprintf('Cleanup: removing %d stale vacancies...', $vacanciesToDelete->count()));

        foreach ($vacanciesToDelete as $vacancy) {
            $vacancy->vacancyValues()->delete();
            $vacancy->delete();
        }

        $this->info(sprintf('Cleanup: removed %d stale vacancies.', $vacanciesToDelete->count()));
    }

    protected function syncSingleJobs(): void
    {
        $vacancies = Vacancy::all();
        $candidates = $vacancies->filter(fn ($v) => $this->getNullFields($v)->isNotEmpty());

        if ($candidates->isEmpty()) {
            $this->info('No vacancies with missing fields — skipping single-job sync.');
            return;
        }

        $this->info(sprintf('Filling missing fields for %d vacancies...', $candidates->count()));

        $bar = $this->output->createProgressBar($candidates->count());
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %message%');
        $bar->setMessage('');
        $bar->start();

        $updated = 0;
        foreach ($candidates as $vacancy) {
            $bar->setMessage($vacancy->uid);
            if ($this->syncSingleJob($vacancy, $this->getNullFields($vacancy))) {
                $updated++;
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info(sprintf('Synced single-job data for %d of %d vacancies.', $updated, $candidates->count()));
    }

    protected function getNullFields(Vacancy $vacancy): Collection
    {
        return collect($vacancy->getAttributes())
            ->filter(fn ($value) => $value === null)
            ->keys();
    }

    protected function syncSingleJob(Vacancy $vacancy, Collection $nullFields): bool
    {
        $jobData = $this->fetchSingleJob($vacancy->uid);

        if ($jobData === null || ($jobData['uid'] ?? null) !== $vacancy->uid) {
            return false;
        }

        $vacancy->forceFill($this->buildUpdateData($jobData, $nullFields))->save();
        return true;
    }

    protected function fetchSingleJob(string $uid): ?array
    {
        $response = Http::withHeaders(['Ows-Api-Key' => config('vacancy.api.key')])
            ->accept('application/json')
            ->withQueryParameters(['language' => 'nl'])
            ->get(self::API_BASE . '/' . $uid);

        if (! $response->successful()) {
            return null;
        }

        return $response->json()[0] ?? null;
    }

    protected function buildUpdateData(array $jobData, Collection $nullFields): array
    {
        $updateData = [];

        foreach ($nullFields as $field) {
            if (! isset($jobData[$field])) {
                continue;
            }

            $value = $this->normalizeFieldValue($field, $jobData[$field]);

            if ($value !== null) {
                $updateData[$field] = $value;
            }
        }

        return $updateData;
    }

    protected function normalizeFieldValue(string $field, $value)
    {
        if (! $this->isLegacyDate($field, $value)) {
            return $value;
        }

        return $this->parseLegacyDate($field, $value);
    }

    protected function isLegacyDate(string $field, $value): bool
    {
        return str_contains($field, 'Date')
            && is_string($value)
            && ! str_contains($value, '-');
    }

    protected function parseLegacyDate(string $field, string $value): ?string
    {
        $trimmed = substr($value, 0, 8);

        if (strlen($trimmed) !== 8) {
            Log::error("Invalid date format for field {$field}: {$value}");
            return null;
        }

        try {
            return Carbon::createFromFormat('Ymd', $trimmed)->format('Y-m-d');
        } catch (Exception $e) {
            Log::error("Failed to parse date for field {$field}: {$value}");
            return null;
        }
    }

    protected function getHeadingsBasedOnType(Collection $data, string $type): array
    {
        $newData = [];

        foreach ($data as $headings) {
            $vacancy = Vacancy::where('uid', $headings['vacancyData']['uid'])->first();

            foreach ($headings[$type] as $key => $value) {
                $newData[] = [
                    'unique_key' => $key,
                    'key' => 'value_title',
                    'value' => $value,
                    'value_optimized' => Str::substr($value, 0, 64),
                    'vacancy_id' => $vacancy->id,
                ];
            }
        }

        return $newData;
    }

    protected function getBodyFields(Collection $data, string $type): array
    {
        $newData = [];

        foreach ($data as $criteria) {
            $vacancy = Vacancy::where('uid', $criteria['vacancyData']['uid'])->first();

            foreach ($criteria[$type] as $key => $values) {
                foreach ($values ?? [] as $subKey => $subValue) {
                    $newData[] = [
                        'unique_key' => $key,
                        'key' => $subKey,
                        'value' => $subValue,
                        'value_optimized' => Str::substr($subValue, 0, 64),
                        'vacancy_id' => $vacancy->id,
                    ];
                }
            }
        }

        return $newData;
    }

    private function getVacancyResponse(Collection $data): Collection
    {
        return $data->map(fn ($value) => [
            'vacancyData' => $this->extractVacancyProps($value),
            'textFieldTitles' => $value['textFieldTitles'],
            'textFields' => $this->extractTextFields($value),
            'criteria' => $value['matchCriteriaNames'],
            'criteriaFields' => $this->extractCriteriaFields($value),
        ]);
    }

    private function extractVacancyProps(array $value): array
    {
        $urls = collect($value['urls'])->first();
        $vacancyData = ['language' => 'nl', 'slug' => Str::slug($value['title'])];

        foreach ($this->vacancyProps as $prop) {
            $vacancyData[$prop] = $value[$prop] ?? null;
        }

        $vacancyData['applyUrl'] = $urls['applyUrl'] ?? null;
        $vacancyData['jobUrl'] = $urls['jobUrl'] ?? null;

        return array_merge($vacancyData, $this->extractHoursBounds($value));
    }

    /**
     * @return array{hours_min: ?int, hours_max: ?int, hours_values: ?string}
     */
    protected function extractHoursBounds(array $value): array
    {
        $raw = $this->firstHoursString($value['matchCriteria_8'] ?? null);

        if ($raw === null) {
            return ['hours_min' => null, 'hours_max' => null, 'hours_values' => null];
        }

        $parsed = HoursParser::parse($raw, $value['uid'] ?? null);

        if ($parsed === null) {
            $this->hoursUnparseable++;
            return ['hours_min' => null, 'hours_max' => null, 'hours_values' => null];
        }

        $this->hoursParsed++;

        return [
            'hours_min' => $parsed['min'],
            'hours_max' => $parsed['max'],
            'hours_values' => $parsed['values'] !== null ? json_encode($parsed['values']) : null,
        ];
    }

    protected function firstHoursString(mixed $criteria): ?string
    {
        if (is_string($criteria)) {
            return trim($criteria) !== '' ? $criteria : null;
        }

        if (is_array($criteria)) {
            foreach ($criteria as $entry) {
                if (is_string($entry) && trim($entry) !== '') {
                    return $entry;
                }
            }
        }

        return null;
    }

    protected function reportHoursDiagnostic(): void
    {
        $this->info(sprintf(
            'Hours parsing: %d parsed, %d unparseable (logged).',
            $this->hoursParsed,
            $this->hoursUnparseable,
        ));
    }

    private function extractTextFields(array $value): array
    {
        $textFields = [];

        foreach ($value['textFieldTitles'] as $key => $_) {
            if (isset($value[$key])) {
                $textFields[$key] = $value[$key];
            }
        }

        return $textFields;
    }

    private function extractCriteriaFields(array $value): array
    {
        $criteriaFields = [];

        foreach ($value['matchCriteriaNames'] as $key => $_) {
            if (! empty($value[$key])) {
                $criteriaFields[$key] = $value[$key];
            }
        }

        return $criteriaFields;
    }
}
