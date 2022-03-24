<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\Collections\MessageCollection;
use Infobip\Resources\SMS\Models\Destination;
use Infobip\Resources\SMS\Models\Message;
use Infobip\Resources\SMS\Models\SendingSpeedLimit;
use Infobip\Resources\SMS\SendBinarySMSMessageResource;
use Tests\TestCase;

final class SendBinarySMSMessageResourceTest extends TestCase
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

        $expectedArray = [
            'bulkId' => $bulkId,
            'messages' => $messages->toArray(),
            'sendingSpeedLimit' => $sendingSpeedLimit,
        ];

        // act
        $sendBinarySMSMessageResource = (new SendBinarySMSMessageResource())
            ->addMessage($message)
            ->setBulkId($bulkId)
            ->setSendingSpeedLimit($sendingSpeedLimit);

        // assert
        $this->assertSame($expectedArray, $sendBinarySMSMessageResource->payload());
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
        $sendBinarySMSMessageResource = (new SendBinarySMSMessageResource())
            ->addMessage($message)
            ->setSendingSpeedLimit($sendingSpeedLimit);

        // assert
        $this->assertSame($expectedArray, $sendBinarySMSMessageResource->payload());
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
        $sendBinarySMSMessageResource = (new SendBinarySMSMessageResource())
            ->addMessage($message);

        // assert
        $this->assertSame($expectedArray, $sendBinarySMSMessageResource->payload());
    }
}
