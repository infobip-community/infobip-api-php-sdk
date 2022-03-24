<?php

declare(strict_types=1);

namespace Tests\Validations\Rules;

use Infobip\Validations\Attributes\StringAttribute;
use Infobip\Validations\Rules\EmailRule;
use Tests\TestCase;

final class EmailRuleTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRuleWithDataProvider(?string $value, bool $expectedPasses): void
    {
        $rule = new EmailRule('attributeName', $value);

        $this->assertSame($expectedPasses, $rule->passes());
    }

    public function dataProvider(): iterable
    {
        yield 'null value passes' => [null, true];
        yield 'empty value fails' => ['', false];

        yield 'valid email 1' => ['info@infobip.com', true];
        yield 'valid email 2' => ['info@api.infobip.com', true];
        yield 'valid email 3' => ['info.api@infobip.com', true];
        yield 'valid email 4' => ['info.api@api.infobip.com', true];
        yield 'valid email 5' => ['info-api@infobip.com', true];

        yield 'invalid email 1' => ['Infobip', false];
        yield 'invalid email 2' => ['infobip.com', false];
        yield 'invalid email 3' => ['@infobip.com', false];
        yield 'invalid email 4' => ['info@infobip', false];
        yield 'invalid email 5' => ['info@infobip-com', false];
    }
}
