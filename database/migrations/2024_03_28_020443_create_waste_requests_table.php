<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasteRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waste_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->text('uuid');
            $table->integer('category_id')->comment('if 1 then other waste 2 then e-waste')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('image')->nullable();
            $table->integer('employee_remark')->nullable();
            $table->text('ward')->nullable();
            $table->text('area')->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('waste_requests');
    }
}
