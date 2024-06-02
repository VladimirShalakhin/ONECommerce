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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('buy_date')->nullable(false)->comment('Время покупки');
            $table->integer('product_id')->nullable(false)->comment('Идентификатор продукта в заказе');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
        });
        //чтобы формат даты был день.месяц.год
        DB::statement('ALTER DATABASE onecommerce SET datestyle TO "ISO, DMY"');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
