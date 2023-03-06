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
        //

        Schema::table('anime_chapters',function(Blueprint $table){
            $table->integer('anime_id');
            $table->foreign('anime_id')->references('mal_id')->on('animes')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('anime_chapters',function(Blueprint $table){
           $table->dropForeign('anime_chapters_anime_id_foreign');
           $table->dropColumn('anime_id');
        });
    }
};
