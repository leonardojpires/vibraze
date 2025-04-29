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
        Schema::table('bands', function (Blueprint $table) {
            $table->string('singer')->nullable()->after('description');
            $table->string('lead_guitarist')->nullable()->after('singer');
            $table->string('rythm_guitarist')->nullable()->after('lead_guitarist');
            $table->string('bassist')->nullable()->after('rythm_guitarist');
            $table->string('drummer')->nullable()->after('bassist');
            $table->string('percussionist')->nullable()->after('drummer');
            $table->string('keyboardist')->nullable()->after('percussionist');
            $table->string('dj')->nullable()->after('keyboardist');
            $table->string('backing_vocals')->nullable()->after('dj');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bands', function (Blueprint $table) {
            Schema::dropIfExists('bands');
        });
    }
};
