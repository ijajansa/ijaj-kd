<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recycles', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('mobile_number')->nullable();
            $table->text('ward')->nullable();
            $table->text('address')->nullable();
            $table->text('weight')->nullable();
            $table->text('category')->nullable()->comment('1 - sale, 2 - reuse - 3 - recycle');
            $table->double('payment',8,2)->default(0);
            $table->text('receipt')->nullable();
            $table->integer('type')->default(1)->comment('1 - CD, 2 - E-waste');
            $table->date('added_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recycles');
    }
};
