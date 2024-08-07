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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('cover')->default('/common/default-product.svg');
            $table->unsignedBigInteger('brand_id');
            $table->string('sku');
            $table->string('barcode')->nullable();
            $table->decimal('sale_price', 10, 2);
            $table->decimal('actual_purchase_price', 10, 2)->default(0.00);
            $table->timestamps();

            $table->index('brand_id', 'product_brand_idx');

            $table->foreign('brand_id', 'product_brand_fk')
                ->on('brands')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
