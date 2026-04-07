<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_news', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(\Galaxy\Website\Models\Website::class)->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Modules\WebsiteNews\Models\WebsiteNewsCategory::class)->nullable()->constrained()->onDelete('cascade');

            $table->json('title');
            $table->json('slug');
            $table->json('intro')->nullable();
            $table->json('content');
            $table->json('author')->nullable();
            $table->date('date')->nullable();

            $table->boolean('published')->default(1);
            $table->date('publish_at')->nullable();
            $table->date('unpublish_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_news');
    }
};
