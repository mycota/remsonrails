<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('country_currency_symbol_id')->unsigned();
            $table->string('customer_name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('gender');
            $table->string('pincode');
            $table->string('address');
            $table->string('place');
            $table->string('customer_type')->default('Onsite');
            $table->boolean('deleted')->default(1);
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
        Schema::dropIfExists('customers');
    }
}
