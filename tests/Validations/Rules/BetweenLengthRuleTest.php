<?php

declare(strict_types=1);

namespace Tests\Validations\Rules;

use Infobip\Validations\Rules\BetweenLengthRule;
use Tests\TestCase;

final class BetweenLengthRuleTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRuleWithDataProvider(?string $value, int $minLength, int $maxLength, bool $expectedPasses): void
    {
        $rule = new BetweenLengthRule('attributeName', $value, $minLength, $maxLength);

        $this->assertSame($expectedPasses, $rule->passes());
    }

    public function dataProvider(): iterable
    {
        yield 'null value passes 1' => [null, 0, 0, true];
        yield 'null value passes 2' => [null, 5, 10, true];

        yield 'empty value passes 1' => ['', 0, 0, true];
        yield 'empty values passes 2' => ['', 0, 5, true];
        yield 'empty values fails' => ['', 5, 10, false];

        yield 'value passes 1' => ['John', 0, 4, true];
        yield 'value passes 2' => ['John', 4, 4, true];
        yield 'value passes 3' => ['John', 4, 5, true];
        yield 'value passes 4' => ['John', 3, 5, true];
        yield 'value passes 5' => ['John', 3, 4, true];

        yield 'value fails 1' => ['John', 0, 3, false];
        yield 'value fails 2' => ['John', 5, 10, false];
    }
}
