<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('lote');
            $table->string('manzana');
            $table->string('calle');
            $table->string('dimenciones');
            $table->string('colonia');
            $table->string('numero_terreno');
            $table->double('price');
            $table->string('bar_code');
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('branch_office_id')->nullable();
            $table->foreign('branch_office_id')->references('id')->on('branch_offices')->onDelete('cascade');
            $table->timestamps();
            // $table->integer('minimun_stock')->nullable();
            // $table->decimal('cost',8,2);
            // $table->date('expiration')->nullable();
            // $table->decimal('iva',8,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
