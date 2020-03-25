<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraglasstypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extraglasstypes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quotationID');
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
        Schema::dropIfExists('extraglasstypes');
    }
}
