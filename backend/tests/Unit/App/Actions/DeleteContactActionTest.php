<?php

namespace Tests\Unit\App\Actions;

use App\Actions\DeleteContactAction;
use App\Events\ContactDeleted;
use App\Models\Contact;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class DeleteContactActionTest extends TestCase
{
    public function testCanDeleteAContactSuccessfully(): void
    {
        Event::fake();

        (new DeleteContactAction())
            ->handle($contact = Contact::factory()->create());

        Event::assertDispatched(ContactDeleted::class);

        $this->assertDatabaseMissing(Contact::class, [
            'id' => $contact->id,
        ]);
    }
}
