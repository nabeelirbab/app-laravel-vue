<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArtistTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('artist_user_type_id')->after('status')->unsigned()->nullable();
            $table->foreign('artist_user_type_id')
                ->references('id')
                ->on('artist_types');
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

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['artist_user_type_id']);
            $table->dropColumn('artist_user_type_id');
        });

        Schema::dropIfExists('artist_types');
    }
}
