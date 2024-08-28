<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)->unique();
            $table->timestamps();
        });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->unsignedBigInteger('author_id');
            $table->text('description')->nullable();
            $table->year('year_of_publication');
            $table->string('image_path', 2048)->nullable();
            $table->string('isbn', 10)->unique();
            $table->timestamps();

            $table->unique(['title', 'author_id']);

            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('zip_code', 10);
            $table->string('street')->nullable();
            $table->string('complement')->nullable();
            $table->string('unit')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city');
            $table->string('state', 2);
            $table->unsignedBigInteger('author_id');

            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');

        Schema::dropIfExists('books');

        Schema::dropIfExists('authors');
    }
};
