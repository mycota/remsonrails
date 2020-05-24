<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRailingReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('railing_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quotation_order_id')->unsigned();
            $table->string('quotOrdID');
            $table->integer('railingNo');
            $table->string('shapetype_RIN')->nullable();
            $table->string('coner_RIN')->nullable();
            $table->string('wc_RIN')->nullable();
            $table->string('connt_RIN')->nullable();
            $table->string('encap_RIN')->nullable();
            $table->string('brcktype_RIN')->nullable();
            $table->string('mg_RIN', 1000)->nullable();
            $table->string('mgl_RIN', 1000)->nullable();
            $table->string('conto_RIN', 1000)->nullable();
            $table->string('glasNo_RIN', 1000)->nullable();
            $table->string('glasNol_RIN', 1000)->nullable();
            $table->string('mgc_RIN', 1000)->nullable();
            $table->string('glasNoc_RIN', 1000)->nullable();
            $table->string('mgr_RIN', 1000)->nullable();
            $table->string('glasNor_RIN', 1000)->nullable();
            $table->string('mgv_RIN', 1000)->nullable();
            $table->string('glasNov_RIN', 1000)->nullable();
            $table->string('mgh_RIN', 1000)->nullable();
            $table->string('glasNoh_RIN', 1000)->nullable();
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
        Schema::dropIfExists('railing_reports');
    }
}
