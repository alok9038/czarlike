<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191)->nullable();
            $table->string('image')->nullable();
            $table->text('description', 65535)->nullable();
            $table->foreignId('parent_cat')->constrained('categories')->onDelete('cascade')->unsigned();
            $table->foreignId('parent_sub_cat')->constrained('sub_categories')->onDelete('cascade')->unsigned()->nullable();
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
        Schema::dropIfExists('child_categories');
    }
}
