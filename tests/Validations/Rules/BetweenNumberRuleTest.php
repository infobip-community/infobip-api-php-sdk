<?php

declare(strict_types=1);

namespace Tests\Validations\Rules;

use Infobip\Validations\Attributes\NumberAttribute;
use Infobip\Validations\Rules\BetweenNumberRule;
use Infobip\Validations\Rules\MaxNumberRule;
use Tests\TestCase;

final class BetweenNumberRuleTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRuleWithDataProvider(?float $value, float $min, float $max, bool $expectedPasses): void
    {
        $rule = new BetweenNumberRule('attributeName', $value, $min, $max);

        $this->assertSame($expectedPasses, $rule->passes());
    }

    public function dataProvider(): iterable
    {
        yield 'null value passes 1' => [null, 0, 0, true];
        yield 'null value passes 2' => [null, 0, 5, true];

        yield 'zero value passes' => [0, 0, 0, true];
        yield 'zero values fails' => [0, 0, 5, true];

        yield 'integer value passes 1' => [3, 3, 4, true];
        yield 'integer value passes 2' => [4, 4, 4, true];
        yield 'integer value passes 3' => [4, 4, 5, true];
        yield 'integer value passes 4' => [-10, -15, -5, true];

        yield 'integer value fails 1' => [5, 0, 4, false];
        yield 'integer value fails 2' => [-5, -10, -6, false];

        yield 'decimal value passes 1' => [3.999, 3.5, 4, true];
        yield 'decimal value passes 2' => [4, 4.000, 4.001, true];
        yield 'decimal value passes 3' => [-5.0001, -6.000, -5.000, true];

        yield 'decimal value fails 1' => [4.00, 4.0001, 4.0009, false];
        yield 'decimal value fails 2' => [-5.00, -5.0001, -5.0009, false];
    }
}
