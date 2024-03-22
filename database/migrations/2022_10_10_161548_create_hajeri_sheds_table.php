<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHajeriShedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hajeri_sheds', function (Blueprint $table) {
            $table->increments('id');
            $table->text('hajeri_shed')->nullable();
            $table->text('description')->nullable();
            $table->integer('ward_id');
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('hajeri_sheds');
    }
}
