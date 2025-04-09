<?php

namespace Tests\Feature\Http\Controllers;

use App\Facades\Twilio;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Tests\TestCase;
use Twilio\Rest\Api\V2010\Account\CallInstance;
use Twilio\TwiML\VoiceResponse;

class TwilioControllerTest extends TestCase
{
    public function testMakeCallSuccessfully(): void
    {
        $contact = Contact::factory()->create([
            'phone' => '+5511999999999',
            'name' => 'John Doe'
        ]);

        $mock = $this->createMock(CallInstance::class);
        $mock->sid = 'CA1234567890';

        Twilio::shouldReceive('makeCall')
            ->with($contact->phone, $contact->name)
            ->andReturn($mock);

        $this->actingAs(User::factory()->make())
            ->postJson(route('twilio.make.call', $contact))
            ->assertOk()
            ->assertJson([
                'message' => 'Chamada iniciada!',
                'call_sid' => $mock->sid,
            ]);
    }

    public function testVoiceResponseReturnsValidXml(): void
    {
        $response = $this->post(route('twilio.voice', ['contactName' => 'John Doe']))
            ->assertOk()
            ->assertHeader('Content-Type', 'text/xml; charset=UTF-8');

        $this->assertStringContainsString('<Say', $response->content());
        $this->assertStringContainsString('Olá, John Doe.', $response->content());
    }

    public function testVoiceResponseContainsContactName(): void
    {
        $this->post(route('twilio.voice', ['contactName' => $contactName = 'Nuno Maduro']))
            ->assertSee($contactName, false);
    }
}
