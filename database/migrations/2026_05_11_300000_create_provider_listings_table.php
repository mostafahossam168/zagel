<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provider_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('contact_phone');
            $table->string('contact_whatsapp')->nullable();
            $table->string('contact_email')->nullable();
            $table->json('contact_links')->nullable(); // facebook, twitter, linkedin, etc.
            $table->string('status')->default('pending'); // pending / approved / rejected
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_listings');
    }
};
