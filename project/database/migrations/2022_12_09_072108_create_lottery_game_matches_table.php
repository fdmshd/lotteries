<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery_game_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')
                ->references('id')
                ->on('lottery_games');
            $table->date('start_date');
            $table->time('start_time');
            $table->foreignId('winner_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lottery_game_matches');
    }
};
