<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->timestamps();
        });

        Schema::create('article_partner', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('article_id');
            $table->unsignedInteger('partner_id');

            $table->timestamps();
        });

        Schema::create('partner_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('partner_id');

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
        Schema::dropIfExists('partners_tables');
    }
}
