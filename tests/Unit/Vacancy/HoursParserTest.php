<?php

namespace Tests\Unit\Vacancy;

use App\Modules\Vacancy\Support\HoursParser;
use Galaxy\GalaxyTests\Tests\Unit\GalaxyTestCase;

class HoursParserTest extends GalaxyTestCase
{
    /**
     * @dataProvider validInputs
     */
    public function testParsesValidInputs(string $input, array $expected): void
    {
        $this->assertSame($expected, HoursParser::parse($input));
    }

    public static function validInputs(): array
    {
        return [
            'single integer' => ['32', ['min' => 32, 'max' => 32, 'values' => [32]]],
            'single integer with uur suffix' => ['32 uur', ['min' => 32, 'max' => 32, 'values' => [32]]],
            'single integer with uren suffix' => ['40 uren', ['min' => 40, 'max' => 40, 'values' => [40]]],
            'comma list' => ['32,40', ['min' => 32, 'max' => 40, 'values' => [32, 40]]],
            'comma list with spaces' => ['32, 40', ['min' => 32, 'max' => 40, 'values' => [32, 40]]],
            'comma list three values' => ['24, 32, 40', ['min' => 24, 'max' => 40, 'values' => [24, 32, 40]]],
            'comma list with uur suffix' => ['32,40 uur', ['min' => 32, 'max' => 40, 'values' => [32, 40]]],
            'comma list deduplicates' => ['32,32,40', ['min' => 32, 'max' => 40, 'values' => [32, 40]]],
            'comma list sorts' => ['40,24,32', ['min' => 24, 'max' => 40, 'values' => [24, 32, 40]]],
            'range' => ['24-40', ['min' => 24, 'max' => 40, 'values' => null]],
            'range with spaces' => ['24 - 40', ['min' => 24, 'max' => 40, 'values' => null]],
            'range with uur suffix' => ['24-40 uur', ['min' => 24, 'max' => 40, 'values' => null]],
            'legacy format 0-24' => ['0-24 uur', ['min' => 0, 'max' => 24, 'values' => null]],
            'legacy format 24-32' => ['24-32 uur', ['min' => 24, 'max' => 32, 'values' => null]],
            'legacy format 32-40' => ['32-40 uur', ['min' => 32, 'max' => 40, 'values' => null]],
            'reversed range gets normalised' => ['40-24', ['min' => 24, 'max' => 40, 'values' => null]],
            'range with same bounds becomes single' => ['32-32', ['min' => 32, 'max' => 32, 'values' => [32]]],
            'leading and trailing whitespace' => ['  32  ', ['min' => 32, 'max' => 32, 'values' => [32]]],
            'uppercase suffix' => ['32 UUR', ['min' => 32, 'max' => 32, 'values' => [32]]],
            'per week suffix' => ['32 per week', ['min' => 32, 'max' => 32, 'values' => [32]]],
            'u/wk suffix' => ['32 u/wk', ['min' => 32, 'max' => 32, 'values' => [32]]],
            'zero is in bounds' => ['0', ['min' => 0, 'max' => 0, 'values' => [0]]],
            'eighty is in bounds' => ['80', ['min' => 80, 'max' => 80, 'values' => [80]]],
        ];
    }

    /**
     * @dataProvider invalidInputs
     */
    public function testReturnsNullForInvalidInputs(?string $input): void
    {
        $this->assertNull(HoursParser::parse($input));
    }

    public static function invalidInputs(): array
    {
        return [
            'null' => [null],
            'empty string' => [''],
            'whitespace only' => ['   '],
            'only uur suffix' => ['uur'],
            'pure garbage' => ['nope'],
            'mixed range and list' => ['24,32-40'],
            'negative number' => ['-5'],
            'over upper bound' => ['100'],
            'range over upper bound' => ['24-100'],
            'decimal number' => ['32.5'],
            'multiple dashes' => ['24-32-40'],
            'trailing comma alone' => [','],
            'comma with empty parts' => [','],
        ];
    }
}
