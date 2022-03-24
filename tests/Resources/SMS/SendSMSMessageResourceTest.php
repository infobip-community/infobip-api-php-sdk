<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\Collections\MessageCollection;
use Infobip\Resources\SMS\Models\Destination;
use Infobip\Resources\SMS\Models\Message;
use Infobip\Resources\SMS\Models\SendingSpeedLimit;
use Infobip\Resources\SMS\Models\Tracking;
use Infobip\Resources\SMS\SendSMSMessageResource;
use Tests\TestCase;

final class SendSMSMessageResourceTest extends TestCase
{
    public function testCanResourceWithAllData(): void
    {
        // arrange
        $bulkId = 'bulkId';
        $sendingSpeedLimit = new SendingSpeedLimit(25);
        $messages = new MessageCollection();
        $message = new Message();
        $destination = new Destination('to');
        $message->addDestination($destination);
        $messages->add($message);
        $tracking = new Tracking();
        $tracking->setBaseUrl('baseUrl');

        $expectedArray = [
            'bulkId' => $bulkId,
            'messages' => $messages->toArray(),
            'sendingSpeedLimit' => $sendingSpeedLimit,
            'tracking' => $tracking
        ];

        // act
        $sendSMSMessageResource = (new SendSMSMessageResource())
            ->addMessage($message)
            ->setBulkId($bulkId)
            ->setSendingSpeedLimit($sendingSpeedLimit)
            ->setTracking($tracking);

        // assert
        $this->assertSame($expectedArray, $sendSMSMessageResource->payload());
    }

    public function testCanResourceWithPartialData(): void
    {
        // arrange
        $sendingSpeedLimit = new SendingSpeedLimit(25);
        $messages = new MessageCollection();
        $message = new Message();
        $destination = new Destination('to');
        $message->addDestination($destination);
        $messages->add($message);

        $expectedArray = [
            'messages' => $messages->toArray(),
            'sendingSpeedLimit' => $sendingSpeedLimit,
        ];

        // act
        $sendSMSMessageResource = (new SendSMSMessageResource())
            ->addMessage($message)
            ->setSendingSpeedLimit($sendingSpeedLimit);

        // assert
        $this->assertSame($expectedArray, $sendSMSMessageResource->payload());
    }

    public function testCanCreateCreateResourceWithRequiredData(): void
    {
        // arrange
        $messages = new MessageCollection();
        $message = new Message();
        $destination = new Destination('to');
        $message->addDestination($destination);
        $messages->add($message);

        $expectedArray = [
            'messages' => $messages->toArray(),
        ];

        // act
        $sendSMSMessageResource = (new SendSMSMessageResource())
            ->addMessage($message);

        // assert
        $this->assertSame($expectedArray, $sendSMSMessageResource->payload());
    }
}
