<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('website_news', function (Blueprint $table) {
            $table->foreignId('canvas_id')->nullable()->constrained()->after('website_id');
        });
    }

    public function down()
    {
        Schema::table('website_news', function (Blueprint $table) {
            $table->dropConstrainedForeignId('canvas_id');
        });
    }
};
