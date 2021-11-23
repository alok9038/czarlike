<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('linked_by')->nullable();
            $table->string('url');
            $table->bigInteger('category')->nullable();
            $table->bigInteger('subcategory')->nullable();
            $table->bigInteger('product')->nullable();
            $table->string('heading_text')->nullable();
            $table->string('subheading_text')->nullable();
            $table->string('buttom_text')->nullable();
            $table->string('heading_color')->nullable();
            $table->string('sub_heading_color')->nullable();
            $table->string('button_text_color')->nullable();
            $table->string('button_bg_color')->nullable();
            $table->enum('status', ['active', 'deactive'])->nullable()->default('deactive');
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
        Schema::dropIfExists('sliders');
    }
}
