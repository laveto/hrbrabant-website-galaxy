<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_news_categories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(\Galaxy\Website\Models\Website::class)->nullable()->constrained()->onDelete('cascade');

            $table->json('name');
            $table->json('slug');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_news_categories');
    }
};
