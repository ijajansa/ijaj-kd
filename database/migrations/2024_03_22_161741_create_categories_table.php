<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('is_active')->default(1);
            $table->timestamps();
        });
        Category::insert([
            ['name' => 'Spit'],
            ['name' => 'Toilet'],
            ['name' => 'Water Kept'],
            ['name' => 'CHO Waste'],
            ['name' => 'E-Waste'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
