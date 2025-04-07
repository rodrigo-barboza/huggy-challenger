<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('url', 255);
            $table->string('event', 255);
        });

        DB::table('webhooks')->insert([
            [
                'url' => 'https://huggy-challenger/api/webhooks/contact-created',
                'event' => 'contact.created'
            ],
            [
                'url' => 'https://huggy-challenger/api/webhooks/contact-updated',
                'event' => 'contact.updated'
            ],
            [
                'url' => 'https://huggy-challenger/api/webhooks/contact-deleted',
                'event' => 'contact.deleted'
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('webhooks');
    }
};
