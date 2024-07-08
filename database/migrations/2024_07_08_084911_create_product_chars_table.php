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
        Schema::create('product_chars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('char_id');
            $table->string('value');
            $table->timestamps();

            $table->index('product_id', 'product_chars_product_idx');
            $table->index('char_id', 'product_chars_char_idx');

            $table->foreign('product_id', 'product_chars_product_fk')
                ->on('products')
                ->references('id');
            $table->foreign('char_id', 'product_chars_char_fk')
                ->on('chars')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_chars');
    }
};
