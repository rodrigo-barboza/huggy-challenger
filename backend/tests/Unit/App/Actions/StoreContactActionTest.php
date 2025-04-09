<?php

namespace Tests\Unit\App\Actions;

use App\Actions\StoreContactAction;
use App\Dtos\ContactDto;
use App\Events\ContactCreated;
use App\Models\Contact;
use Illuminate\Support\Facades\Event;
use PDOException;
use Tests\TestCase;

class StoreContactActionTest extends TestCase
{
    public function testCanStoreAContactSuccessfully(): void
    {
        Event::fake();

        (new StoreContactAction())
            ->handle($contact = new ContactDto(
                name: 'John Doe',
                email: 'M5a5o@example.com',
                phone: '123456789',
                cellphone: '123456789'
            ));

        Event::assertDispatched(ContactCreated::class);

        $this->assertDatabaseHas(Contact::class, [
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => "+55{$contact->phone}",
            'cellphone' => $contact->cellphone,
        ]);
    }

    public function testWhenATransactionFailsBecauseDatabaseConstraintViolation(): void
    {
        Event::fake();

        $existent_contact = Contact::factory()->create(['email' => 'nunomaduro@example.com']);

        $contact = new ContactDto(
            name: 'Nuno Maduro Fake',
            email: 'nunomaduro@example.com',
            phone: '123456789',
            cellphone: '123456789'
        );

        $this->expectException(PDOException::class);
        $this->expectExceptionMessage('Integrity constraint violation: 19 UNIQUE constraint failed: contacts.email');

        (new StoreContactAction())->handle($contact);

        Event::assertNotDispatched(ContactCreated::class);

        $this->assertDatabaseHas(Contact::class, [
            'name' => $existent_contact->name,
            'email' => 'nunomaduro@example.com',
        ]);

        $this->assertDatabaseMissing(Contact::class, [
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => "+55{$contact->phone}",
            'cellphone' => $contact->cellphone,
        ]);
    }
}
