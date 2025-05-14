<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
           
            $table->foreignId('order_id')->constrained()->onDelete('cascade');  // Links to orders table
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Links to products table
            $table->decimal('price', 10, 2);    // Price per unit at time of order
            $table->integer('quantity');        // Quantity ordered
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
