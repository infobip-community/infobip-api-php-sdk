<?php

declare(strict_types=1);

namespace Tests\Endpoints\SMS;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipServerException;
use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\SMS\Models\Message;
use Infobip\Resources\SMS\SendSMSMessageResource;
use Tests\Endpoints\TestCase;

final class SendSMSMessageTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/SMS/send_sms_message_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->SMS()
            ->sendSMSMessage($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsServerErrorException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/SMS/general_sms_error.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SERVER_ERROR,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipServerException::class);
        $this->expectExceptionCode(StatusCode::SERVER_ERROR);
        $this->expectExceptionMessage($mockedResponse['requestError']['serviceException']['text']);

        // act
        $response = $this
            ->getInfobipClient()
            ->SMS()
            ->sendSMSMessage($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsValidationException(): void
    {
        // arrange
        $resource = $this->getInvalidResource();

        $this->setMockedGuzzleHttpClient(StatusCode::NO_CONTENT);

        // act & assert
        $this->expectException(InfobipValidationException::class);
        $this->expectExceptionCode(StatusCode::UNPROCESSABLE_ENTITY);

        try {
            $this
                ->getInfobipClient()
                ->SMS()
                ->sendSMSMessage($resource);
        } catch (InfobipValidationException $exception) {
            $this->assertArrayHasKey('message.callbackData', $exception->getValidationErrors());
            $this->assertArrayHasKey('message.validityPeriod', $exception->getValidationErrors());

            throw $exception;
        }
    }

    private function getResource(): SendSMSMessageResource
    {
        return new SendSMSMessageResource();
    }

    private function getInvalidResource(): SendSMSMessageResource
    {
        $message = (new Message())
            ->setCallbackData('
                Lorem ipsum dolor sit amet, consectetuer adipiscing eli
                t. Aenean commodo ligula eget dolor. Aenean massa. Cum 
                sociis natoque penatibus et magnis dis parturient monte
                s, nascetur ridiculus mus. Donec quam felis, ultricies 
                nec, pellentesque eu, pretium quis, sem. Nulla consequa
                t massa quis enim. Donec pede justo, fringilla vel, ali
                quet nec, vulputate eget, arcu. In enim justo, rhoncus 
                ut, imperdiet a, venenatis vitae, justo. Nullam dictum 
                felis eu pede mollis pretium. Integer tincidunt. Cras d
                apibus. Vivamus elementum semper nisi. Aenean vulputate
                 eleifend tellus. Aenean leo ligula, porttitor eu, cons
                equat vitae, eleifend ac, enim. Aliquam lorem ante, dap
                ibus in, viverra quis, feugiat a, tellus. Phasellus viv
                erra nulla ut metus varius laoreet. Quisque rutrum. Aen
                ean imperdiet. Etiam ultricies nisi vel augue. Curabitu
                r ullamcorper ultricies nisi. Nam eget dui. Etiam rhonc
                us. Maecenas tempus, tellus eget condimentum rhoncus, s
                em quam semper libero, sit amet adipiscing sem neque se
                d ipsum. Nam quam nunc, blandit vel, luctus pulvinar, h
                endrerit id, lorem. Maecenas nec odio et ante tincidunt
                 tempus. Donec vitae sapien ut libero venenatis faucibu
                s. Nullam quis ante. Etiam sit amet orci eget eros fauc
                ibus tincidunt. Duis leo. Sed fringilla mauris sit amet
                 nibh. Donec sodales sagittis magna. Sed consequat, leo
                 eget bibendum sodales, augue velit cursus nunc, quis g
                ravida magna mi a libero. Fusce vulputate eleifend sapi
                en. Vestibulum purus quam, scelerisque ut, mollis sed, 
                nonummy id, metus. Nullam accumsan lorem in dui. Cras u
                ltricies mi eu turpis hendrerit fringilla. Vestibulum a
                nte ipsum primis in faucibus orci luctus et ultrices po
                suere cubilia Curae; In ac dui quis mi consectetuer lac
                inia. Nam pretium turpis et arcu. Duis arcu tortor, sus
                cipit eget, imperdiet nec, imperdiet iaculis, ipsum. Se
                d aliquam ultrices mauris. Integer ante arcu, accumsan 
                a, consectetuer eget, posuere ut, mauris. Praesent adip
                iscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc n
                onummy metus. Vestibulum volutpat pretium libero. Cras 
                id dui. Aenean ut eros et nisl sagittis vestibulum. Nul
                lam nulla eros, ultricies sit amet, nonummy id, imperdi
                et feugiat, pede. Sed lectus. Donec mollis hendrerit ri
                sus. Phasellus nec sem in justo pellentesque facilisis.
                 Etiam imperdiet imperdiet orci. Nunc nec neque. Phasel
                lus leo dolor, tempus non, auctor et, hendrerit quis, n
                isi. Curabitur ligula sapien, tincidunt non, euismod vi
                tae, posuere imperdiet, leo. Maecenas malesuada. Praese
                nt congue erat at massa. Sed cursus turpis vitae tortor
                . Donec posuere vulputate arcu. Phasellus accumsan curs
                us velit. Vestibulum ante ipsum primis in faucibus orci
                 luctus et ultrices posuere cubilia Curae; Sed aliquam,
                 nisi quis porttitor congue, elit erat euismod orci, ac
                 placerat dolor lectus quis orci. Phasellus consectetue
                r vestibulum elit. Aenean tellus metus, bibendum sed, p
                osuere ac, mattis non, nunc. Vestibulum fringilla pede 
                sit amet augue. In turpis. Pellentesque posuere. Praese
                nt turpis. Aenean posuere, tortor sed cursus feugiat, n
                unc augue blandit nunc, eu sollicitudin urna dolor sagi
                ttis lacus. Donec elit libero, sodales nec, volutpat a,
                 suscipit non, turpis. Nullam sagittis. Suspendisse pul
                vinar, augue ac venenatis condimentum, sem libero volut
                pat nibh, nec pellentesque velit pede quis nunc. Vestib
                ulum ante ipsum primis in faucibus orci luctus et ultri
                ces posuere cubilia Curae; Fusce id purus. Ut varius ti
                ncidunt libero. Phasellus dolor. Maecenas vestibulum mo
                llis diam. Pellentesque ut neque. Pellentesque habitant
                 morbi tristique senectus et netus et malesuada fames a
                c turpis egestas. In dui magna, posuere eget, vestibulu
                m et, tempor auctor, justo. In ac felis quis tortor mal
                esuada pretium. Pellentesque auctor neque nec urna. Pro
                in sapien ipsum, porta a, auctor quis, euismod ut, mi. 
                Aenean viverra rhoncus pede. Pellentesque habitant morb
                i tristique senectus et netus et malesuada fames ac tur
                pis egestas. Ut non enim eleifend felis pretium feugiat
                . Vivamus quis mi. Phasellus a est. Phasellus magna. In
                 hac habitasse platea dictumst. Curabitur at lacus ac v
                elit ornare lobortis. Curabitur a felis in nunc fringil
                la tristique. Morbi mattis ullamcorper velit. Phasellus
                 gravida semper nisi. Nullam vel sem. Pellentesque libe
                ro tortor, tincidunt et, tincidunt eget, semper nec, qu
                am. Sed hendrerit. Morbi ac felis. Nunc egestas, augue 
                at pellentesque laoreet, felis eros vehicula leo, at ma
                lesuada velit leo quis pede. Donec interdum, metus et h
                endrerit aliquet, dolor diam sagittis ligula, eget eges
                tas libero turpis vel mi. Nunc nulla. Fusce risus nisl,
                 viverra et, tempor et, pretium in, sapien. Donec venen
                atis vulputate lorem. Morbi nec metus. Phasellus blandi
                t leo ut odio. Maecenas ullamcorper, dui et placerat fe
                ugiat, eros pede varius nisi, condimentum viverra felis
                 nunc et lorem. Sed magna purus, fermentum eu, tincidun
                t eu, varius ut, felis. In auctor lobortis lacus. Quisq
                ue libero metus, condimentum nec, tempor a, commodo mol
                lis, magna. Vestibulum ullamcorper mauris at ligul
            ')
            ->setValidityPeriod(3000);

        return (new SendSMSMessageResource())
            ->addMessage($message);
    }
}
