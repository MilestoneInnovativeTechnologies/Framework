<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceFormFieldDependsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('__resource_form_field_depends', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('form_field')->index();
            $table->string('depend_field', 64)->index()->nullable();
            $table->string('db_field', 64)->nullable();
            $table->enum('operator', ['=','<','>','<=','>=','<>','In','NotIn','like'])->default('=');
            $table->string('compare_method', 128)->nullable();
            $table->string('method', 128)->nullable();
            $table->string('value_db_field', 64)->nullable();
            $table->enum('ignore_null', ['Yes','No'])->default('Yes');
            $table->timestamps();
            $table->foreign('form_field')->references('id')->on('__resource_form_fields')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('__resource_form_field_depends');
    }
}
