<?php

declare(strict_types=1);

namespace Tests\Validations\Rules;

use Infobip\Validations\Attributes\NumberAttribute;
use Infobip\Validations\Rules\MinNumberRule;
use Tests\TestCase;

final class MinNumberRuleTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRuleWithDataProvider(?float $value, float $min, bool $expectedPasses): void
    {
        $rule = new MinNumberRule('attributeName', $value, $min);

        $this->assertSame($expectedPasses, $rule->passes());
    }

    public function dataProvider(): iterable
    {
        yield 'null value passes 1' => [null, 0, true];
        yield 'null value passes 2' => [null, 5, true];

        yield 'zero value passes' => [0, 0, true];
        yield 'zero values fails' => [0, 5, false];

        yield 'integer value passes 1' => [4, 3, true];
        yield 'integer value passes 2' => [4, 4, true];
        yield 'integer value passes 3' => [-5, -10, true];

        yield 'integer value fails 1' => [4, 5, false];
        yield 'integer value fails 2' => [-10, -5, false];

        yield 'decimal value passes 1' => [4, 3.999, true];
        yield 'decimal value passes 2' => [4, 4.000, true];
        yield 'decimal value passes 3' => [-5.000, -5.001, true];

        yield 'decimal value fails 1' => [4.000, 4.001, false];
        yield 'decimal value fails 2' => [-5.001, -5.000, false];
    }
}
