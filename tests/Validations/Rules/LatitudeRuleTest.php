<?php

declare(strict_types=1);

namespace Tests\Validations\Rules;

use Infobip\Validations\Rules\LatitudeRule;
use Tests\TestCase;

final class LatitudeRuleTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRuleWithDataProvider(?float $value, bool $expectedPasses): void
    {
        $rule = new LatitudeRule('latitude', $value);

        $this->assertSame($expectedPasses, $rule->passes());
    }

    public function dataProvider(): iterable
    {
        yield 'null value passes' => [null, true];
        yield 'zero value passes' => [0, true];

        yield 'value passes 1' => [-90, true];
        yield 'value passes 2' => [-89.5, true];
        yield 'value passes 3' => [-45, true];
        yield 'value passes 4' => [45, true];
        yield 'value passes 5' => [89.5, true];
        yield 'value passes 6' => [90, true];

        yield 'value fails 1' => [-120, false];
        yield 'value fails 2' => [-90.01, false];
        yield 'value fails 3' => [90.01, false];
        yield 'value fails 4' => [120, false];
    }
}
