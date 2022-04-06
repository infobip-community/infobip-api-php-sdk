<?php

declare(strict_types=1);

namespace Tests\Endpoints\RCS;

use Infobip\Enums\StatusCode;
use Infobip\Resources\RCS\Models\CarouselContent;
use Infobip\Resources\RCS\Models\CarouselMessageContent;
use Infobip\Resources\RCS\RCSMessageResource;
use Infobip\Resources\RCS\Enums\CardWidth;
use Tests\Endpoints\TestCase;

final class SendRCSMessageTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/RCS/send_RCS_message_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->RCS()
            ->sendRCSMessage($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsBadRequestException(): void
    {
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/RCS/send_RCS_message_bad_request.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->RCS()
            ->sendRCSMessage($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    private function getResource(): RCSMessageResource
    {
        $content = new CarouselMessageContent(new CardWidth(CardWidth::SMALL));

        return new RCSMessageResource(
            'mediaId',
            $content
        );
    }
}
