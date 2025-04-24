<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // USERS
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user'); // 'user' ou 'admin'
            $table->rememberToken();
            $table->timestamps();
        });

        // GENRES
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // BANDS
        Schema::create('bands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('genre_id')->constrained('genres')->onDelete('cascade');
            $table->year('formation_year');
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // FAVORITES
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('band_id')->constrained('bands')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'band_id']); // Para evitar favoritos duplicados
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('bands');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('users');
    }
};
