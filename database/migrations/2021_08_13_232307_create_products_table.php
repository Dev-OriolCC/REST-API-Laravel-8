<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // New
             // New table fields
             $table->string('name');
             $table->text('description');
             $table->decimal('price');
             $table->string('color');
             $table->enum('status', [Product::PUBLISHED, Product::UNPUBLISHED])->default(Product::UNPUBLISHED);
             // Foreign Keys
             $table->foreignId('category_id')->constrained()->onDelete('cascade');
             $table->foreignId('brand_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
