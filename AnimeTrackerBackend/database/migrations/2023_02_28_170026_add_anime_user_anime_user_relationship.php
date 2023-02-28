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

        Schema::table('anime_user',function(Blueprint $table){
            $table->foreignId('user_id')->constrained();
        });


        Schema::table('anime_user',function(Blueprint $table){
            $table->foreignId('anime_id')->constrained();
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

        Schema::table('anime_user',function(Blueprint $table){
            $table->dropForeign('anime_user_user_id_foreign');
            $table->dropColumn('user_id');
         });


         Schema::table('anime_user',function(Blueprint $table){
            $table->dropForeign('anime_user_anime_id_foreign');
            $table->dropColumn('anime_id');
         });

    }
};
