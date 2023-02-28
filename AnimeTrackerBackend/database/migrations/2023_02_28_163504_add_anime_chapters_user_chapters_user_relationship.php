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
        Schema::table('user_chapters',function(Blueprint $table){
            $table->foreignId('user_id')->constrained();
        });


        Schema::table('user_chapters',function(Blueprint $table){
            $table->foreignId('anime_chapter_id')->constrained();
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

        Schema::table('user_chapters',function(Blueprint $table){
            $table->dropForeign('user_chapters_user_id_foreign');
            $table->dropColumn('user_id');
         });


         Schema::table('user_chapters',function(Blueprint $table){
            $table->dropForeign('user_chapters_anime_chapter_id_foreign');
            $table->dropColumn('anime_chapter_id');
         });
    }
};
