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
        Schema::create('vacancy_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Modules\Vacancy\Models\Vacancy::class)->constrained();
            $table->string('unique_key');
            $table->string('key')->nullable();
            $table->text('value')->nullable();
            $table->timestamps();

            $table->unique(['unique_key', 'key', 'vacancy_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancy_values');
    }
};
