<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // Kolom id auto-increment
            $table->string('title'); // Kolom title (string)
            $table->string('slug')->unique(); // Kolom slug (string) dengan unique constraint
            $table->string('author_name'); // Kolom author_name (string)
            $table->text('content'); // Kolom content (text)
            $table->string('image_url'); // Kolom image_url (string)
            $table->text('excerpt'); // Kolom excerpt (text)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
