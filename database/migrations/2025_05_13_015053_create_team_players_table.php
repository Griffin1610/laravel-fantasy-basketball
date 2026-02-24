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
    public function up()
    {
        // Enable foreign key constraints for SQLite
        if (config('database.default') === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        }
        
        Schema::create('team_players', function (Blueprint $table) {
            $table->id();
            // Use string type to match players.id which is TEXT in SQLite
            // Note: Foreign key constraint removed due to SQLite type mismatch issues
            $table->string('player_id');
            $table->timestamps();
            
            // Add index for better performance
            $table->index('player_id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_players');
    }
};
