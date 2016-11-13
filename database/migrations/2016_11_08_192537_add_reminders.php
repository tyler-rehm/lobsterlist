<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReminders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('team_id')->index()->unsigned();
            $table->foreign('team_id')->references('id')->on('teams');

            $table->integer('contact_id')->index()->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts');

            $table->string('notes');
            $table->date('date');
            $table->time('time')->nullable();

            $table->integer('reminder_status_id')->default(1)->unsigned();
            $table->foreign('reminder_status_id')->references('id')->on('reminder_statuses');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reminders');
        Schema::drop('reminder_statuses');
    }
}
