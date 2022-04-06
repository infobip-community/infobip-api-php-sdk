<?php

declare(strict_types=1);

namespace Tests\Endpoints\RCS;

use Infobip\Enums\StatusCode;
use Infobip\Resources\RCS\Models\CarouselContent;
use Infobip\Resources\RCS\Models\CarouselMessageContent;
use Infobip\Resources\RCS\Enums\CardWidth;
use Infobip\Resources\RCS\RCSBulkMessageResource;
use Tests\Endpoints\TestCase;

final class SendBulkRCSMessageTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/RCS/send_bulk_RCS_message_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->RCS()
            ->sendBulkRCSMessage($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsBadRequestException(): void
    {
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/RCS/send_bulk_RCS_message_bad_request.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->RCS()
            ->sendBulkRCSMessage($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    private function getResource(): RCSBulkMessageResource
    {
        $content = new CarouselMessageContent(
            new CardWidth(CardWidth::SMALL)
        );

        return new RCSBulkMessageResource(
            'mediaId',
            $content
        );
    }
}
