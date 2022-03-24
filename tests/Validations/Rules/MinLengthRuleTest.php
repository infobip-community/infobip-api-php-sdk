<?php

declare(strict_types=1);

namespace Tests\Validations\Rules;

use Infobip\Validations\Rules\MinLengthRule;
use Tests\TestCase;

final class MinLengthRuleTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRuleWithDataProvider(?string $value, int $minLength, bool $expectedPasses): void
    {
        $rule = new MinLengthRule('attributeName', $value, $minLength);

        $this->assertSame($expectedPasses, $rule->passes());
    }

    public function dataProvider(): iterable
    {
        yield 'null value passes 1' => [null, 0, true];
        yield 'null value passes 2' => [null, 5, true];

        yield 'empty value passes' => ['', 0, true];
        yield 'empty values fails' => ['', 5, false];

        yield 'value passes 1' => ['John', 3, true];
        yield 'value passes 2' => ['John', 4, true];

        yield 'value fails' => ['John', 5, false];
    }
}
