<?php

declare(strict_types=1);

namespace App\Services;

use Twilio\Rest\Api\V2010\Account\CallInstance;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;

final class TwilioService
{
    public function __construct(private Client $twilio)
    {
    }

    public function makeCall(string $toNumber, string $contactName): CallInstance
    {
        return $this->twilio->calls->create(
            $toNumber,
            config('services.twilio.phone_number'),
            [
                'url' => secure_url(route('twilio.voice', $contactName)),
            ]
        );
    }

    public function voiceResponse(string $contactName): VoiceResponse
    {
        $response = new VoiceResponse();

        $response->say(
            "Olá, {$contactName}. Estamos conectando você a um atendente.",
            ['voice' => 'alice', 'language' => 'pt-BR']
        );

        $response->dial(
            config('services.twilio.phone_number'),
            [
                'action' => route('twilio.call.status'),
                'method' => 'POST',
                'timeout' => config('services.twilio.call_timeout'),
            ]
        );

        return $response;
    }
}
