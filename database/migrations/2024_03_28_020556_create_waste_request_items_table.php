<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasteRequestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waste_request_items', function (Blueprint $table) {
            $table->increments('id');
            $table->text('uuid');
            $table->integer('category_id')->nullable();
            $table->text('name')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('actual_qty')->nullable();
            $table->integer('request_id')->nullable();
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
        Schema::dropIfExists('waste_request_items');
    }
}
