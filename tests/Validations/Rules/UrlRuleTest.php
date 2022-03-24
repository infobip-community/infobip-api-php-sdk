<?php

declare(strict_types=1);

namespace Tests\Validations\Rules;

use Infobip\Validations\Attributes\StringAttribute;
use Infobip\Validations\Rules\UrlRule;
use Tests\TestCase;

final class UrlRuleTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRuleWithDataProvider(?string $value, bool $expectedPasses): void
    {
        $rule = new UrlRule('attributeName', $value);

        $this->assertSame($expectedPasses, $rule->passes());
    }

    public function dataProvider(): iterable
    {
        yield 'null value passes' => [null, true];
        yield 'empty value fails' => ['', false];

        yield 'valid url 1' => ['http://infobip.com', true];
        yield 'valid url 2' => ['http://infobip.com/', true];
        yield 'valid url 3' => ['http://www.infobip.com', true];
        yield 'valid url 4' => ['http://www.infobip.com/', true];
        yield 'valid url 5' => ['https://infobip.com', true];
        yield 'valid url 6' => ['https://infobip.com/', true];
        yield 'valid url 7' => ['https://www.infobip.com', true];
        yield 'valid url 8' => ['https://www.infobip.com/', true];
        yield 'valid url 9' => ['https://api.infobip.com', true];
        yield 'valid url 10' => ['https://api.infobip.com/', true];
        yield 'valid url 11' => ['https://www.api.infobip.com', true];
        yield 'valid url 12' => ['https://www.api.infobip.com/', true];
        yield 'valid url 13' => ['https://api.infobip.com/docs/api', true];
        yield 'valid url 14' => ['https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-text-message', true];

        yield 'invalid url 1' => ['Infobip', false];
        yield 'invalid url 2' => ['infobip.com', false];
        yield 'invalid url 3' => ['www.infobip.com', false];
        yield 'invalid url 4' => ['api.infobip.com', false];
        yield 'invalid url 5' => ['www.api.infobip.com', false];
        yield 'invalid url 6' => ['api.infobip.com/docs', false];
        yield 'invalid url 7' => ['api.infobip.com/docs/api', false];
        yield 'invalid url 8' => ['www.api.infobip.com/docs/api', false];
    }
}
