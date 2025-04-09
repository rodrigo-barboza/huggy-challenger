<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    public function testCanGetAllContactsSuccessfully(): void
    {
        $contact = Contact::factory()->create();

        $this->actingAs(User::factory()->make())
            ->getJson(route('contacts.index'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'email',
                        'phone',
                        'cellphone',
                        'address',
                        'neighborhood',
                        'state',
                    ],
                ],
            ])
            ->assertJsonCount(1, 'data')
            ->assertJson([
                'data' => [
                    [
                        'id' => $contact->id,
                        'name' => $contact->name,
                        'email' => $contact->email,
                        'phone' => $contact->phone,
                        'cellphone' => $contact->cellphone,
                        'address' => $contact->address,
                        'neighborhood' => $contact->neighborhood,
                        'state' => $contact->state,
                    ],
                ]
            ]);
    }

    public function testCanGetAllContactsOrderedByCreatedAtSuccessfully(): void
    {
        $older_contact = Contact::factory()->create(['created_at' => now()->subDays(2)]);
        $newer_contact = Contact::factory()->create(['created_at' => now()->subDays(1)]);

        $this->actingAs(User::factory()->make())
            ->getJson(route('contacts.index'))
            ->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJson([
                'data' => [
                    ['id' => $newer_contact->id],
                    ['id' => $older_contact->id],
                ],
            ]);
    }

    public function testCanGetAllContactsPaginatedSuccessfully(): void
    {
        Contact::factory(30)->create();

        $this->actingAs(User::factory()->make())
            ->getJson(route('contacts.index'))
            ->assertOk()
            ->assertJsonCount(20, 'data')
            ->assertJsonFragment([
                'per_page' => 20,
                'total' => 30,
            ])
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'email',
                        'phone',
                        'cellphone',
                        'address',
                        'neighborhood',
                        'state',
                    ],
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ]);
    }

    public function testCanStoreContactSuccessfully(): void
    {
        Event::fake();

        $this->actingAs(User::factory()->make())
            ->postJson(route('contacts.store'), $contact = [
                'name' => 'Nuno Maduro',
                'email' => 'nunomaduro@example.com',
                'phone' => '123456789',
                'cellphone' => '123456789',
                'address' => 'Rua 1',
                'neighborhood' => 'Bairro 1',
                'state' => 'sp',
            ])
            ->assertCreated()
            ->assertJson(['message' => 'Contato criado com sucesso']);

        $this->assertDatabaseHas(Contact::class, array_merge($contact, [
            'phone' => "+55{$contact['phone']}",
        ]));
    }

    public function testConnotStoreContactWithoutName(): void
    {
        $this->actingAs(User::factory()->make())
            ->postJson(route('contacts.store'), $contact = [
                'email' => 'nunomaduro@example.com',
                'phone' => '123456789',
                'cellphone' => '123456789',
                'address' => 'Rua 1',
                'neighborhood' => 'Bairro 1',
                'state' => 'sp',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);
    }

    public function testCanUpdateContactSuccessfully(): void
    {
        Event::fake();

        $contact = Contact::factory()->create(['name' => 'Nuno Maduro']);

        $r = ($this->actingAs(User::factory()->make())
            ->putJson(
                route('contacts.update', $contact),
                [
                        'name' => 'Nuno Maduro Matos',
                        'email' => 'nunomaduro@example.com',
                        'phone' => '123456789',
                        'cellphone' => '123456789',
                ],
            ))
            ->assertOk()
            ->assertJson(['message' => 'Contato atualizado com sucesso']);

        $this->assertDatabaseHas(Contact::class, [
            'id' => $contact->id,
            'name' => 'Nuno Maduro Matos',
        ]);
    }

    public function testCanDeleteContactSuccessfully(): void
    {
        Event::fake();

        $contact = Contact::factory()->create();

        $this->actingAs(User::factory()->make())
            ->deleteJson(route('contacts.destroy', $contact))
            ->assertOk()
            ->assertJson(['message' => 'Contato deletado com sucesso']);

        $this->assertDatabaseMissing(Contact::class, ['id' => $contact->id]);
    }
}
