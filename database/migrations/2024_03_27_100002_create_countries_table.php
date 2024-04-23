<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('title_ru')->unique();
            $table->string('title_en')->unique();
            $table->softDeletes();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
