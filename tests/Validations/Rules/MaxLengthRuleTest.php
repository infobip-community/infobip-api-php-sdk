<?php

declare(strict_types=1);

namespace Tests\Validations\Rules;

use Infobip\Validations\Rules\MaxLengthRule;
use Tests\TestCase;

final class MaxLengthRuleTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRuleWithDataProvider(?string $value, int $minLength, bool $expectedPasses): void
    {
        $rule = new MaxLengthRule('attributeName', $value, $minLength);

        $this->assertSame($expectedPasses, $rule->passes());
    }

    public function dataProvider(): iterable
    {
        yield 'null value passes 1' => [null, 0, true];
        yield 'null value passes 2' => [null, 5, true];

        yield 'empty value passes 1' => ['', 0, true];
        yield 'empty values passes 2' => ['', 5, true];

        yield 'value passes 1' => ['John', 4, true];
        yield 'value passes 2' => ['John', 5, true];

        yield 'value fails' => ['John', 3, false];
    }
}
