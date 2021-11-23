<?php

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
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->unsigned();
            $table->foreignId('sub_cat_id')->constrained('sub_categories')->onDelete('cascade')->unsigned()->nullable();
            $table->foreignId('child_category_id')->constrained('child_categories')->unsigned()->nullable();
            // $table->integer('grand_id')->nullable();
            $table->integer('store_id')->unsigned()->nullable();
            $table->integer('vender_id')->unsigned()->nullable();
            $table->foreignId('brand_id')->constrained('brands')->unsigned()->nullable();
            $table->string('name', 191)->nullable();
            $table->text('des', 65535)->nullable();
            $table->text('tags', 65535)->nullable();
            $table->string('model', 191)->nullable();
            $table->string('sku', 191)->nullable();
            $table->float('price', 10, 0)->nullable();
            $table->string('offer_price', 191)->nullable();
            $table->enum('featured', array('0','1'));
            $table->enum('status', array('0','1'));
            $table->integer('tax')->default(0);
            $table->integer('codcheck')->unsigned()->nullable();
            $table->integer('free_shipping')->nullable();
            $table->string('return_avbl', 100);
            $table->boolean('cancel_avl')->nullable();
            $table->text('key_features', 65535)->nullable();
            $table->float('vender_price', 10, 0)->nullable();
            $table->float('vender_offer_price', 10, 0)->nullable();
            $table->string('commission_rate', 191)->nullable();
            $table->integer('shipping_id')->unsigned()->nullable();
            $table->integer('return_policy')->nullable();
            $table->string('tax_r', 191)->nullable();
            $table->string('tax_name', 191)->nullable();
            $table->softDeletes();
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
