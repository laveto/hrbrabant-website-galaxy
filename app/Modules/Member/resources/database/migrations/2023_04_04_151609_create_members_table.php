<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(\Galaxy\Website\Models\Website::class)->nullable()->constrained()->onDelete('cascade');

            $table->json('title');
            $table->json('subtitle');
            $table->json('slug');
            $table->json('content');
            $table->integer('sequence');

            $table->string('email');
            $table->string('linkedin');
            $table->string('whatsapp');

            $table->boolean('published');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
