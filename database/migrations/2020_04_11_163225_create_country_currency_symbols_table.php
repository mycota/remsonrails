<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryCurrencySymbolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_currency_symbols', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country');
            $table->string('currency');
            $table->string('code');
            $table->string('symbol');
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
        Schema::dropIfExists('country_currency_symbols');
    }
}
