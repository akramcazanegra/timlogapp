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
            $table->string('product_name')->nullable();
            $table->string('category_id')->nullable();
            $table->string('supplier_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable(); // Add this line
            $table->string('product_code')->nullable();
            $table->string('product_garage')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_store')->nullable();
            $table->string('buying_date')->nullable();
            $table->string('expire_date')->nullable();
            $table->string('buying_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->timestamps();


            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null'); // Foreign key constraint
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
