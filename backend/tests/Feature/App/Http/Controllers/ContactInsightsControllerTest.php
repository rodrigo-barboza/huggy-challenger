<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Tests\TestCase;

class ContactInsightsControllerTest extends TestCase
{
    public function testCanGetInsightsSuccessfully(): void
    {
        Contact::factory()->create();

        $this->actingAs(User::factory()->create())
            ->getJson(route('contacts.insights'))
            ->assertJsonStructure([
                'data' => [
                    'contacts-by-state' => [
                        'title',
                        'data' => [
                            '*' => [
                                'state',
                                'total'
                            ],
                        ],
                    ],
                    'contacts-with-phone' => [
                        'title',
                        'data' => [
                            '*' => [
                                'has_phone',
                                'total'
                            ],
                        ],
                    ],
                ],
            ]);
    }

    public function testCanGetInsightsWithoutDataSuccessfully(): void
    {
        $this->actingAs(User::factory()->create())
            ->getJson(route('contacts.insights'))
            ->assertJson([
                'data' => [
                    'contacts-by-state' => [
                        'title' => 'Segmentação por estado',
                        'data' => [],
                    ],
                    'contacts-with-phone' => [
                        'title' => 'Contatos com e sem telefone',
                        'data' => [],
                    ],
                ],
            ]);
    }
}
