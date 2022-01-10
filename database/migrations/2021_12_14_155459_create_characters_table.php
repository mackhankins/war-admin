<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('character_name');
            $table->string('character_company');
            $table->string('guilded_name');
            $table->integer('character_level');
            $table->string('primary_role');
            $table->string('primary_weapon');
            $table->integer('primary_weapon_level');
            $table->string('second_weapon');
            $table->integer('second_weapon_level');
            $table->integer('gear_score')->default(0);
            $table->string('third_weapon')->nullable();
            $table->string('fourth_weapon')->nullable();
            $table->string('fifth_weapon')->nullable();
            $table->boolean('share_information')->default('1');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
