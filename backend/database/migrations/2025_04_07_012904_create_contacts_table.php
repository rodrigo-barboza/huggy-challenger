<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('address', 255)->nullable();
            $table->string('cellphone', 15);
            $table->string('email', 255)->unique();
            $table->string('name', 100);
            $table->string('neighborhood', 255)->nullable();
            $table->string('phone', 15);
            $table->string('state', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
