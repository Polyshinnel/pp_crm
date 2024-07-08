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
        Schema::create('product_params', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('param_id');
            $table->string('value');
            $table->timestamps();

            $table->index('product_id', 'product_params_product_idx');
            $table->index('param_id', 'product_params_param_idx');

            $table->foreign('product_id', 'product_params_product_fk')
                ->on('products')
                ->references('id');
            $table->foreign('param_id', 'product_params_param_fk')
                ->on('params')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_params');
    }
};
