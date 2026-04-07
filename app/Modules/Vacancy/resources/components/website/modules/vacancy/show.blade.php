@extends('website::layouts.main', [
    'title' => $vacancy->title,
])

@section('main.content')

    <div class="{{ $cssNs }}">

        <livewire:vacancy.view
            :websitePage='$websitePage'
            :vacancy='$vacancy'
        />

    </div>

@endsection

@push('foot')
    @php
        // Get description and summary from vacancy values
        $description = $vacancy->vacancyValues
            ->where('unique_key', 'textField_description')
            ->where('key', '!=', 'value_title')
            ->where('key', '!=', 'title')
            ->first();
        
        $summary = $vacancy->vacancyValues
            ->where('unique_key', 'textField_summary')
            ->where('key', '!=', 'value_title')
            ->first();
        
        // Build structured data for job posting
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'JobPosting',
            'title' => $vacancy->title,
            'datePosted' => $vacancy->publicationFirstDate ? $vacancy->publicationFirstDate->toIso8601String() : $vacancy->created_at->toIso8601String(),
            'validThrough' => $vacancy->publicationEndDate ? $vacancy->publicationEndDate->toIso8601String() : null,
            'employmentType' => 'FULL_TIME', // You may want to make this dynamic based on vacancy data
            'hiringOrganization' => [
                '@type' => 'Organization',
                'name' => config('app.name', 'HR Zeeland'),
                'sameAs' => config('app.url'),
            ],
        ];
        
        // Add description if available
        if ($description) {
            $structuredData['description'] = strip_tags($description->value);
        } elseif ($summary) {
            $structuredData['description'] = strip_tags($summary->value);
        }
        
        // Add job location if available
        if ($vacancy->location || $vacancy->locationCity || $vacancy->locationCountry) {
            $structuredData['jobLocation'] = [
                '@type' => 'Place',
                'address' => [
                    '@type' => 'PostalAddress',
                ],
            ];
            
            if ($vacancy->locationAddress) {
                $structuredData['jobLocation']['address']['streetAddress'] = $vacancy->locationAddress;
            }
            if ($vacancy->locationCity) {
                $structuredData['jobLocation']['address']['addressLocality'] = $vacancy->locationCity;
            }
            if ($vacancy->locationState) {
                $structuredData['jobLocation']['address']['addressRegion'] = $vacancy->locationState;
            }
            if ($vacancy->locationCountry) {
                $structuredData['jobLocation']['address']['addressCountry'] = $vacancy->locationCountryCode ?: $vacancy->locationCountry;
            }
        }
        
        // Add salary information if available
        if ($vacancy->salaryMin || $vacancy->salaryMax || $vacancy->salaryValue) {
            $structuredData['baseSalary'] = [
                '@type' => 'MonetaryAmount',
                'currency' => $vacancy->salaryCurrency ?: 'EUR',
            ];
            
            if ($vacancy->salaryValue) {
                $structuredData['baseSalary']['value'] = [
                    '@type' => 'QuantitativeValue',
                    'value' => $vacancy->salaryValue,
                    'unitText' => $vacancy->salaryUnit ?: 'MONTH',
                ];
            } elseif ($vacancy->salaryMin && $vacancy->salaryMax) {
                $structuredData['baseSalary']['value'] = [
                    '@type' => 'QuantitativeValue',
                    // Make sure the values are floats or integers
                    'minValue' => parse_money_fast($vacancy->salaryMin),
                    'maxValue' => parse_money_fast($vacancy->salaryMax),
                    'unitText' => $vacancy->salaryUnit ?: 'MONTH',
                ];
            }
        }
        
        // Add identifier if reference number exists
        if ($vacancy->referenceNr) {
            $structuredData['identifier'] = [
                '@type' => 'PropertyValue',
                'name' => 'Reference Number',
                'value' => $vacancy->referenceNr,
            ];
        }
        
        // Add application URL if available
        if ($vacancy->applyUrl) {
            $structuredData['directApply'] = true;
            $structuredData['url'] = $vacancy->applyUrl;
        } elseif ($vacancy->jobUrl) {
            $structuredData['url'] = $vacancy->jobUrl;
        } else {
            $structuredData['url'] = request()->url();
        }
        
        // Remove null values from the array
        $structuredData = array_filter($structuredData, function($value) {
            return $value !== null;
        });
    @endphp
    
    <script type="application/ld+json">
        {!! json_encode($structuredData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush
