<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->text('category_id', 65535)->nullable();
            $table->string('brand_logo');
            $table->bigInteger('category');
            $table->enum('status', ['active', 'deactive'])->nullable()->default('deactive');
            $table->boolean('image_footer')->nullable()->default(false);
            $table->integer('is_requested')->default(0);
            $table->string('show_image', 191)->nullable();
            $table->text('brand_proof', 65535)->nullable();
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
        Schema::dropIfExists('brands');
    }
}
