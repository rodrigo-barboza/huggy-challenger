<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class GetLeadsFromHuggyFlowControllerTest extends TestCase
{
    public function testHandlesValidContactSuccessfully(): void
    {
        Event::fake();

        $this->postJson(route('huggy.leads'), [
            'contact' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '11999999999',
                'cellphone' => '11988888888',
                'address' => '123 Main St',
                'neighborhood' => 'Downtown',
                'state' => 'SP'
            ]
        ])
            ->assertOk()
            ->assertExactJson([]);
    }

    public function testHandlesMinimalRequiredData(): void
    {
        Event::fake();

        $this->postJson(route('huggy.leads'), [
            'contact' => [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '21999999999',
                'cellphone' => '21988888888'
            ]
        ])
            ->assertOk();
    }
}
