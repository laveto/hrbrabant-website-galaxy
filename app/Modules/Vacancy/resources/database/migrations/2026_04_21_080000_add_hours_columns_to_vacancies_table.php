<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vacancies', function (Blueprint $table) {
            $table->unsignedSmallInteger('hours_min')->nullable()->after('candidatesNeeded');
            $table->unsignedSmallInteger('hours_max')->nullable()->after('hours_min');
            $table->json('hours_values')->nullable()->after('hours_max');

            $table->index('hours_min');
            $table->index('hours_max');
        });
    }

    public function down(): void
    {
        Schema::table('vacancies', function (Blueprint $table) {
            $table->dropIndex(['hours_min']);
            $table->dropIndex(['hours_max']);
            $table->dropColumn(['hours_min', 'hours_max', 'hours_values']);
        });
    }
};
