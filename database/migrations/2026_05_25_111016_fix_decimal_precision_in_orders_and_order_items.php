<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sửa lỗi DECIMAL(10,2) quá nhỏ cho cột total trong orders và price trong order_items.
     * DECIMAL(10,2) chỉ chứa tối đa 99,999,999.99 (~99 triệu VND)
     * DECIMAL(15,2) chứa tối đa 9,999,999,999,999.99 (~9.9 nghìn tỷ VND)
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total', 15, 2)->default(0)->change();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('price', 15, 2)->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total', 10, 2)->default(0)->change();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('price', 12, 2)->change();
        });
    }
};
