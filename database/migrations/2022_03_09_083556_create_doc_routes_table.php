<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doc_id');
            $table->foreign('doc_id')->references('id')->on('documents');

            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id')->references('id')->on('divisions');

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->date('date_received');
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
        Schema::dropIfExists('doc_routes');
    }
}
