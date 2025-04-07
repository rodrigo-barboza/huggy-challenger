<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ContactCreated;
use App\Mail\WelcomeContactMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailToNewContactListener implements ShouldQueue
{
    public function handle(ContactCreated $event): void
    {
        Mail::to($event->contact->email)
            ->later(
                now()->addMinutes(config('app.welcome_mail_delay')),
                new WelcomeContactMail($event->contact)
            );
    }
}
