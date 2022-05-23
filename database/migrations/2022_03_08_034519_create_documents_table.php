<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('documents');
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('origin_id');
            $table->foreign('origin_id')->references('id')->on('origin_offices');

            $table->unsignedBigInteger('mor_id');
            $table->foreign('mor_id')->references('id')->on('means_of_receivings');

            $table->unsignedBigInteger('doctype_id');
            $table->foreign('doctype_id')->references('id')->on('doc_types');

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->string('date_received');
            $table->text('control_number');
            $table->text('subject');
            $table->string('deadline');
            $table->text('action_taken')->nullable();
            $table->text('required_action')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
