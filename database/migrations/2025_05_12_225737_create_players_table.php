<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
     public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->integer('Rk')->nullable();
            $table->string('Player')->nullable();
            $table->string('Pos', 5)->nullable();
            $table->integer('Age')->nullable();
            $table->string('Tm', 5)->nullable();
            $table->integer('G')->nullable();
            $table->integer('GS')->nullable();
            $table->float('MP')->nullable();
            $table->float('FG')->nullable();
            $table->float('FGA')->nullable();
            $table->float('FG_percent')->nullable();
            $table->float('P3')->nullable();
            $table->float('P3A')->nullable();
            $table->float('P3_percent')->nullable();
            $table->float('P2')->nullable();
            $table->float('P2A')->nullable();
            $table->float('P2_percent')->nullable();
            $table->float('eFG_percent')->nullable();
            $table->float('FT')->nullable();
            $table->float('FTA')->nullable();
            $table->float('FT_percent')->nullable();
            $table->float('ORB')->nullable();
            $table->float('DRB')->nullable();
            $table->float('TRB')->nullable();
            $table->float('AST')->nullable();
            $table->float('STL')->nullable();
            $table->float('BLK')->nullable();
            $table->float('TOV')->nullable();
            $table->float('PF')->nullable();
            $table->float('PTS')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
