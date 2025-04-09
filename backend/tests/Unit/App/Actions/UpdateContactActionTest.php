<?php

namespace Tests\Unit\App\Actions;

use App\Actions\UpdateContactAction;
use App\Dtos\ContactDto;
use App\Events\ContactUpdated;
use App\Models\Contact;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UpdateContactActionTest extends TestCase
{
    public function testCanUpdateAContactSuccessfully(): void
    {
        Event::fake();

        $contact = Contact::factory()->create([
            'name' => 'Tailor Otwell',
        ]);

        $contactDto = new ContactDto(
            name: 'Tailor Otwell Silva',
            email: 'tailor@example.com',
            phone: '123456789',
            cellphone: '123456789'
        );

        (new UpdateContactAction())->handle($contactDto, $contact);

        Event::assertDispatched(ContactUpdated::class);

        $this->assertDatabaseHas(
            Contact::class,
            ['name' => $contactDto->name]
        );
    }
}
