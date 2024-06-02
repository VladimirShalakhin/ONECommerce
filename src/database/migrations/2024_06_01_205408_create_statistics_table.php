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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->integer('product_id')->nullable(false)->comment('Идентификатор продукта в заказе');
            $table->integer('category_id')->nullable(false)->comment('Идентификатор категории продукта в заказе');
            $table->date('date')->nullable(false)->comment('Дата на которую осуществлен подсчет количества заказов продукта');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
