<?php

use App\Models\Country;
use App\Models\Genre;
use App\Models\Studio;
use App\Models\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('poster')->nullable();
            $table->string('cover')->nullable();
            $table->string('title_org');
            $table->string('title_ru');
            $table->string('title_en');
            $table->foreignIdFor(Type::class)->constrained();
            $table->foreignIdFor(Genre::class)->nullable()->constrained();
            $table->foreignIdFor(Studio::class)->nullable()->constrained();
            $table->foreignIdFor(Country::class)->constrained();
            $table->enum('age_rating', ['0+', '6+', '12+', '16+', '18+'])->default('18+');
            $table->unsignedInteger('episodes_released');
            $table->unsignedInteger('episodes_total');
            $table->unsignedInteger('duration');
            $table->date('release');
            $table->text('description')->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'ARCHIVE'])->default('DRAFT');
            $table->float('rating')->default(0);
            $table->unsignedInteger('count_assessments')->default(0);
            $table->boolean('is_comment')->default(false);
            $table->boolean('is_rating')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
};
