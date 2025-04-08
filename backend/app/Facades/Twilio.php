<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\TwilioService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static CallInstance makeCall(string $toNumber, string $contactName)
 * @method static VoiceResponse voiceResponse(string $contactName)
 * @see TwilioService
 */

final class Twilio extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return TwilioService::class;
    }
}
