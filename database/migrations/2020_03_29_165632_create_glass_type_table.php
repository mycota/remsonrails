<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlassTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('glass_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quotation_order_id')->unsigned();
            $table->string('quotOrdID');
            $table->string('glasstype');
            $table->string('glassize1')->nullable();
            $table->string('glassize2')->nullable();
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
        Schema::dropIfExists('glass_type');
    }
}
