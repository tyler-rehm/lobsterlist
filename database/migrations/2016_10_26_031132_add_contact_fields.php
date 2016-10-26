<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContactFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function ($table) {
            $table->string('company')->after('name')->nullable();
            $table->string('address1')->after('company')->nullable();
            $table->string('address2')->after('address1')->nullable();
            $table->string('city')->after('address2')->nullable();
            $table->string('state')->after('city')->nullable();
            $table->string('zip')->after('state')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function ($table) {
            $table->dropColumn(['company', 'address1', 'address2', 'city', 'state', 'zip']);
        });
    }
}
