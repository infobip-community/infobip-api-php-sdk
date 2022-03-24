<?php

declare(strict_types=1);

namespace Tests\Validations\Rules;

use Infobip\Validations\Attributes\NumberAttribute;
use Infobip\Validations\Rules\MaxNumberRule;
use Tests\TestCase;

final class MaxNumberRuleTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRuleWithDataProvider(?float $value, float $min, bool $expectedPasses): void
    {
        $rule = new MaxNumberRule('attributeName', $value, $min);

        $this->assertSame($expectedPasses, $rule->passes());
    }

    public function dataProvider(): iterable
    {
        yield 'null value passes 1' => [null, 0, true];
        yield 'null value passes 2' => [null, 5, true];

        yield 'zero value passes' => [0, 0, true];
        yield 'zero values fails' => [0, 5, true];

        yield 'integer value passes 1' => [3, 4, true];
        yield 'integer value passes 2' => [4, 4, true];
        yield 'integer value passes 3' => [-10, -5, true];

        yield 'integer value fails 1' => [5, 4, false];
        yield 'integer value fails 2' => [-5, -10, false];

        yield 'decimal value passes 1' => [3.999, 4, true];
        yield 'decimal value passes 2' => [4, 4.000, true];
        yield 'decimal value passes 3' => [-5.0001, -5.000, true];

        yield 'decimal value fails 1' => [4.001, 4.000, false];
        yield 'decimal value fails 2' => [-5.00, -5.0001, false];
    }
}
