<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('anime_episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('number');
            $table->foreignIdFor(\App\Models\Anime::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('title_org');
            $table->string('title_ru');
            $table->string('title_en');
            $table->date('release_date');
            $table->text('note');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'ARCHIVE'])->default('DRAFT');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anime_episodes');
    }
};
