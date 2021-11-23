<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('plano');
            $table->text('description');
            $table->enum('progress',['Apertura','Asignado', 'En-movimientos','Terminado'])->default('Apertura');
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('manager_user_id')->nullable();
            $table->foreign('manager_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('business_unit_id')->nullable();
            $table->foreign('business_unit_id')->references('id')->on('business_units')->onDelete('cascade');
            $table->decimal('total_investment',8,2)->default(0.00);
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
        Schema::dropIfExists('projects');
    }
}
