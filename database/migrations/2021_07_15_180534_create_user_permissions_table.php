<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->unsigned()->onDelete('cascade')->nullable();
            $table->boolean('dashboard')->nullable()->default(false);
            $table->boolean('manage_users')->nullable()->default(false);
            $table->boolean('customers')->nullable()->default(false);
            $table->boolean('sellers')->nullable()->default(false);
            $table->boolean('admin')->nullable()->default(false);
            $table->boolean('menu_management')->nullable()->default(false);
            $table->boolean('create_store')->nullable()->default(false);
            $table->boolean('product_manage')->nullable()->default(false);
            $table->boolean('brand')->nullable()->default(false);
            $table->boolean('categories_manage')->nullable()->default(false);
            $table->boolean('category')->nullable()->default(false);
            $table->boolean('sub_category')->nullable()->default(false);
            $table->boolean('child_category')->nullable()->default(false);
            $table->boolean('products')->nullable()->default(false);
            $table->boolean('coupons')->nullable()->default(false);
            $table->boolean('locations')->nullable()->default(false);
            $table->boolean('slider')->nullable()->default(false);
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
        Schema::dropIfExists('user_permissions');
    }
}
