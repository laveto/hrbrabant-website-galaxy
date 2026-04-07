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
        \Schema::table('vacancy_values', function (Blueprint $table) {

            $table->string('value_optimized')->after('value')->index();
            $table->index(['unique_key', 'value_optimized']);

        });

        \App\Modules\Vacancy\Models\VacancyValue::query()
            ->update([
                'value_optimized' => \DB::raw('SUBSTR(value, 1, 64)')
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        throw new \Exception('Not implemented!');
    }
};
