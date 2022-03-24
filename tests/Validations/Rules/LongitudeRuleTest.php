<?php

declare(strict_types=1);

namespace Tests\Validations\Rules;

use Infobip\Validations\Rules\LongitudeRule;
use Tests\TestCase;

final class LongitudeRuleTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRuleWithDataProvider(?float $value, bool $expectedPasses): void
    {
        $rule = new LongitudeRule('latitude', $value);

        $this->assertSame($expectedPasses, $rule->passes());
    }

    public function dataProvider(): iterable
    {
        yield 'null value passes' => [null, true];
        yield 'zero value passes' => [0, true];

        yield 'value passes 1' => [-180, true];
        yield 'value passes 2' => [-179.5, true];
        yield 'value passes 3' => [-120, true];
        yield 'value passes 4' => [-90, true];
        yield 'value passes 5' => [90, true];
        yield 'value passes 6' => [120, true];
        yield 'value passes 7' => [179.5, true];
        yield 'value passes 8' => [180, true];

        yield 'value fails 1' => [-200, false];
        yield 'value fails 2' => [-180.01, false];
        yield 'value fails 3' => [180.01, false];
        yield 'value fails 4' => [200, false];
    }
}
