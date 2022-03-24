<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\Collections\PlaceholderCollection;
use Infobip\Resources\SMS\Models\Placeholder;
use Infobip\Resources\SMS\SendTwoFAPinCodeOverSMSResource;
use Tests\TestCase;

final class SendTwoFAPinCodeOverSMSResourceTest extends TestCase
{
    public function testCanResourceWithAllData(): void
    {
        // arrange
        $ncNeeded = false;
        $applicationId =  'applicationId';
        $from = 'from';
        $messageId = 'messageId';
        $placeholder = new Placeholder('firstName', 'John');
        $placeholders = (new PlaceholderCollection())
            ->add($placeholder);
        $to = 'to';

        $expectedArray = [
            'applicationId' => $applicationId,
            'from' => $from,
            'messageId' => $messageId,
            'placeholders' => $placeholders->toArray(),
            'to' => $to
        ];

        $expectedQueryOptionsArray = [
            'ncNeeded' => $ncNeeded,
        ];

        // act
        $sendTwoFAPinCodeOverSMSResource = (new SendTwoFAPinCodeOverSMSResource(
            $applicationId,
            $messageId,
            $to
        ))
            ->setNcNeeded($ncNeeded)
            ->addPlaceholder($placeholder)
            ->setFrom($from);

        // assert
        $this->assertSame($expectedArray, $sendTwoFAPinCodeOverSMSResource->payload());
        $this->assertSame($expectedQueryOptionsArray, $sendTwoFAPinCodeOverSMSResource->queryOptions());
    }

    public function testCanResourceWithPartialData(): void
    {
        // arrange
        $ncNeeded = false;
        $applicationId =  'applicationId';
        $from = 'from';
        $messageId = 'messageId';
        $to = 'to';

        $expectedArray = [
            'applicationId' => $applicationId,
            'from' => $from,
            'messageId' => $messageId,
            'to' => $to
        ];

        $expectedQueryOptionsArray = [
            'ncNeeded' => $ncNeeded,
        ];

        // act
        $sendTwoFAPinCodeOverSMSResource = (new SendTwoFAPinCodeOverSMSResource(
            $applicationId,
            $messageId,
            $to
        ))
            ->setNcNeeded($ncNeeded)
            ->setFrom($from);

        // assert
        $this->assertSame($expectedArray, $sendTwoFAPinCodeOverSMSResource->payload());
        $this->assertSame($expectedQueryOptionsArray, $sendTwoFAPinCodeOverSMSResource->queryOptions());
    }

    public function testCanCreateCreateResourceWithRequiredData(): void
    {
        // arrange
        $applicationId =  'applicationId';
        $messageId = 'messageId';
        $to = 'to';

        $expectedArray = [
            'applicationId' => $applicationId,
            'messageId' => $messageId,
            'to' => $to
        ];

        $expectedQueryOptionsArray = [
            'ncNeeded' => true,
        ];

        // act
        $sendTwoFAPinCodeOverSMSResource = new SendTwoFAPinCodeOverSMSResource(
            $applicationId,
            $messageId,
            $to
        );

        // assert
        $this->assertSame($expectedArray, $sendTwoFAPinCodeOverSMSResource->payload());
        $this->assertSame($expectedQueryOptionsArray, $sendTwoFAPinCodeOverSMSResource->queryOptions());
    }
}
