<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->integer('maufacture_id');
            $table->string('product_name');
            $table->longText('product_short_description');
            $table->longText('product_description');
            $table->float('product_price');
            $table->string('product_size');
            $table->string('product_color');
            $table->integer('publication_status');
            $table->integer('product_quantity');
            $table->string('created_by');

            $table->string('modified_by')->nullable();
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
        Schema::dropIfExists('tbl_product');
    }
}
