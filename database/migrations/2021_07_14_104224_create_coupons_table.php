<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code', 191);
            $table->string('distype', 100);
            $table->string('amount', 191);
            $table->string('link_by', 100);
            $table->bigInteger('cat_id')->unsigned()->index('coupon_category_id_foreign')->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned()->index('coupon_product_id_foreign')->onDelete('cascade');
            $table->integer('is_login')->unsigned()->default(0);
            $table->integer('maxusage')->unsigned()->nullable();
            $table->float('minamount', 10, 0)->nullable();
            $table->dateTime('expirydate');
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
        Schema::dropIfExists('coupons');
    }
}
