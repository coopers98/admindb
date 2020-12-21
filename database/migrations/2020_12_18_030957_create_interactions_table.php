<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interactions', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['in_person', 'email', 'phone', 'sms']);
            $table->timestamp('interaction_timestamp');
            $table->string('geolocation', 1000)->nullable();
            $table->enum('outcome', ['contacted', 'not_home', 'no_answer', 'no_response']);
            $table->foreignId('profile_id')->constrained()->onDelete('cascade');

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
        Schema::dropIfExists('interactions');
    }
}
