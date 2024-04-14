<?php

use App\Models\Product;
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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');

            $table->foreignIdFor(\App\Models\Product::class, 'product_id')
                ->nullable()
                ->constrained();

            $table->timestamps();

//            $table->unsignedBigInteger('product_id');
//            // Define the foreign key relationship and cascading delete
//            $table->foreign('product_id')
//                ->references('id')
//                ->on('products')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
