<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Get existing location data
        $members = DB::table('members')->whereNotNull('location')->get();
        
        // Step 2: Add temporary column
        Schema::table('members', function (Blueprint $table) {
            $table->json('location_temp')->nullable();
        });
        
        // Step 3: Convert existing data to JSON array
        foreach ($members as $member) {
            DB::table('members')
                ->where('id', $member->id)
                ->update(['location_temp' => json_encode([$member->location])]);
        }
        
        // Step 4: Drop old column and rename temp column
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('location');
        });
        
        Schema::table('members', function (Blueprint $table) {
            $table->renameColumn('location_temp', 'location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Add back string location column
        Schema::table('members', function (Blueprint $table) {
            $table->string('location_temp')->nullable();
        });
        
        // Step 2: Convert JSON back to single string (take first value)
        $members = DB::table('members')->whereNotNull('location')->get();
        foreach ($members as $member) {
            $locations = json_decode($member->location, true);
            if ($locations && is_array($locations) && !empty($locations)) {
                DB::table('members')
                    ->where('id', $member->id)
                    ->update(['location_temp' => $locations[0]]);
            }
        }
        
        // Step 3: Replace columns
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('location');
        });
        
        Schema::table('members', function (Blueprint $table) {
            $table->renameColumn('location_temp', 'location');
        });
    }
};
