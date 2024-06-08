<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->morphs('ratingable');
            $table->unsignedInteger('assessment');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
