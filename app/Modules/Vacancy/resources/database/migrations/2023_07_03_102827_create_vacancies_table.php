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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('language');
            $table->string('referenceNr');
            $table->string('title');
            $table->string('slug');
            $table->string('uid')->unique();
            $table->datetime('entryDateTime')->nullable();
            $table->string('status')->nullable();
            $table->string('user')->nullable();
            $table->string('userEmail')->nullable();
            $table->string('salaryCurrency')->nullable();
            $table->string('salaryValue')->nullable();
            $table->string('salaryMin')->nullable();
            $table->string('salaryMax')->nullable();
            $table->string('salaryUnit')->nullable();
            $table->string('location')->nullable();
            $table->string('locationAddress')->nullable();
            $table->string('locationCity')->nullable();
            $table->string('locationState')->nullable();
            $table->string('locationCountry')->nullable();
            $table->string('locationCountryCode')->nullable();
            $table->string('relation')->nullable();
            $table->string('relationContact')->nullable();
            $table->unsignedInteger('candidatesNeeded')->nullable();
            $table->boolean('published')->nullable();
            $table->date('publicationStartDate')->nullable();
            $table->date('publicationEndDate')->nullable();
            $table->datetime('publicationFirstDate')->nullable();
            $table->string('publicationStatus')->nullable();
            $table->string('applyUrl')->nullable();
            $table->string('jobUrl')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
