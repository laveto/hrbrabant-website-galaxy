<?php

namespace App\Modules\Vacancy\Support;

use Illuminate\Support\Facades\Log;

class HoursParser
{
    public const MIN_BOUND = 0;

    public const MAX_BOUND = 80;

    /**
     * Parse a free-text OTYS hours string into structured bounds.
     *
     * @return array{min: int, max: int, values: ?array<int>}|null
     *   - min/max: numeric bounds (always set)
     *   - values: discrete value list when input is a single number or comma list; null for ranges
     *   - returns null when input is empty or unparseable
     */
    public static function parse(?string $raw, ?string $vacancyUid = null): ?array
    {
        $cleaned = self::strip($raw);

        if ($cleaned === '') {
            return null;
        }

        return self::tryRange($cleaned)
            ?? self::tryList($cleaned)
            ?? self::tryExact($cleaned)
            ?? self::reportUnparseable($raw, $vacancyUid);
    }

    private static function strip(?string $raw): string
    {
        if ($raw === null) {
            return '';
        }

        $cleaned = preg_replace('/\b(uren|uur|u\/wk|u\/week|per\s*week|\/week|wk)\b/iu', '', $raw) ?? '';
        $cleaned = preg_replace('/\s+/', '', $cleaned) ?? '';

        return trim($cleaned);
    }

    private static function tryExact(string $cleaned): ?array
    {
        if (! preg_match('/^\d+$/', $cleaned)) {
            return null;
        }

        $value = (int) $cleaned;

        if (! self::inBounds($value)) {
            return null;
        }

        return ['min' => $value, 'max' => $value, 'values' => [$value]];
    }

    private static function tryList(string $cleaned): ?array
    {
        if (! str_contains($cleaned, ',')) {
            return null;
        }

        $parts = array_filter(array_map('trim', explode(',', $cleaned)), fn ($p) => $p !== '');
        $values = [];

        foreach ($parts as $part) {
            if (! preg_match('/^\d+$/', $part)) {
                return null;
            }

            $int = (int) $part;
            if (! self::inBounds($int)) {
                return null;
            }

            $values[] = $int;
        }

        if (empty($values)) {
            return null;
        }

        $values = array_values(array_unique($values));
        sort($values);

        if (count($values) === 1) {
            return ['min' => $values[0], 'max' => $values[0], 'values' => $values];
        }

        return ['min' => min($values), 'max' => max($values), 'values' => $values];
    }

    private static function tryRange(string $cleaned): ?array
    {
        if (! preg_match('/^(\d+)-(\d+)$/', $cleaned, $matches)) {
            return null;
        }

        $a = (int) $matches[1];
        $b = (int) $matches[2];

        if (! self::inBounds($a) || ! self::inBounds($b)) {
            return null;
        }

        $min = min($a, $b);
        $max = max($a, $b);

        if ($min === $max) {
            return ['min' => $min, 'max' => $max, 'values' => [$min]];
        }

        return ['min' => $min, 'max' => $max, 'values' => null];
    }

    private static function inBounds(int $value): bool
    {
        return $value >= self::MIN_BOUND && $value <= self::MAX_BOUND;
    }

    private static function reportUnparseable(?string $raw, ?string $vacancyUid): ?array
    {
        Log::warning('HoursParser: unparseable input', [
            'raw' => $raw,
            'vacancy_uid' => $vacancyUid,
        ]);

        return null;
    }
}
