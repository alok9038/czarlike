<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191)->nullable();
            $table->string('image')->nullable();
            $table->text('description', 65535)->nullable();
            $table->foreignId('parent_cat')->constrained('categories')->onDelete('cascade')->unsigned();
            $table->integer('position')->unsigned()->nullable();
            $table->enum('status', array('0','1'));
            $table->enum('featured', array('0','1'));
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
        Schema::dropIfExists('sub_categories');
    }
}
