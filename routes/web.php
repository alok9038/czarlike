<?php

use App\Http\Controller\Admin\ProductAttributesController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\KeyController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RamRomController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\AssignController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\RatingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Payment\PaytmController;
use App\Http\Controllers\Payment\RazorPayController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\BrandController as SellerBrandController;
use App\Http\Controllers\Seller\DriverController as SellerDriverController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\StoreController as SellerStoreController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\WishlistController;
use App\Models\Contact;
use App\Models\ShippingSetting;
use App\Models\Variant;
use App\Models\Product;
use Illuminate\Support\Facades\Artisan;

Route::post('/customer-list',[UserController::class,'customersList'])->name('customer.list');

Route::post('api/fetch-states', [LocationController::class, 'fetchState']);
Route::post('api/fetch-cities', [LocationController::class, 'fetchCity']);

Route::post('/api/fetch-subcat',[SubCategoryController::class,'fetchSubcat']);
Route::post('/api/fetch-childcat',[ChildCategoryController::class,'fetchChildcat']);

Route::get('/mail',[AdminController::class,'mail']);

Route::get('/slider', function () {
    return view('home.include.slider');
})->name('slider');
// home routes

Route::get('/',[HomeController::class,'index'])->name('homepage');

Route::get('/products', [HomeController::class,'products'])->name('products');
Route::get('/product/{slug}',[HomeController::class,'viewProduct'])->name('view.product');

Route::get('/products-variants',[HomeController::class,'variant_view'])->name('variant.product');


Route::get('/about-us', function () {
    return view('home.pages.about');
})->name('about.us');

Route::get('/contact-us', function () {
    return view('home.pages.contact');
})->name('contact.us');

Route::post('/contact-us', [HomeController::class,'contact_us'])->name('contact.us.store');

Route::get('/privacy-policy', function () {
    return view('home.pages.policy');
})->name('policy');

Route::get('/return-Refund-And-Cancellation-policy', function () {
    return view('home.pages.RRC');
})->name('rrc');

Route::get('/terms-and-conditions', function () {
    return view('home.pages.terms');
})->name('terms');

Route::group(['middleware'=>'auth'],function () {

    Route::get('/cart',[CartController::class,'viewCart'])->name('cart');
    Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('add.to.cart');

    Route::post('/minus-item',[CartController::class,'decreaseCartItem'])->name('decrease.cart.item');

    Route::post('/remove-cart-item',[CartController::class,'removeItem'])->name('remove.cart.item');

    Route::get('/checkout',[CartController::class,'checkout'])->name('checkout');

    Route::post('/payment',[CartController::class,'payment'])->name('checkout.payment');

    Route::post('/payment-redirect',[CartController::class,'payment_redirect'])->name('payment.redirect');

    Route::get('/paytm',[PaytmController::class,'pay'])->name('paytm.payment');
    Route::post('/paytm-callback',[PaytmController::class,'paytmcallback'])->name('paytm.callback');
    // razorpay
    Route::post('/razorpay',[RazorPayController::class,'payment'])->name('razorpay.pay');

    Route::get('/orders',[UserOrderController::class,'index'])->name('my.orders');
    Route::get('/orders-details/{order_id}',[UserOrderController::class,'details'])->name('order.detials');
    Route::post('/cancel-order',[CartController::class,'cancelOrder'])->name('cancel.orders');

    // wishlist
    Route::get('/wishlist',[WishlistController::class,'view'])->name('view.wishlist');
    Route::post('/add-to-wishlist',[WishlistController::class,'add'])->name('add.to.wishlist');
    Route::post('/remove-from-wishlist',[WishlistController::class,'remove'])->name('remove.from.wishlist');

    Route::get('/{slug}/write-review/{id}', [RatingController::class,"review"])->name('home.review');
    Route::post('/write-review-rating', [RatingController::class,"review_rating"])->name('home.rating.insert');
    Route::post('/write-review-rating-update', [RatingController::class,"review_rating_update"])->name('home.rating.update');

    Route::post('/redeem-coupon',[CouponController::class,'redeemCoupon'])->name('redeem.coupon');

    Route::post('/remove-coupon',[CouponController::class,'removeCoupon'])->name('remove.coupon');

    // profile
    Route::post('/change-password',[ProfileController::class,'changePassword'])->name('change.password');
    Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
    Route::post('update-profile-image',[ProfileController::class,"updateDp"])->name('update.dp');
    Route::post('update-details',[ProfileController::class,"updateDetails"])->name('update.details');

    Route::group(['middleware'=>'admins','prefix'=>'admin','as'=>'super.admin.'],function () {

        Route::get('/manage-product/{product_id}', function ($id) {
            $data['variants'] = Variant::where('product_id',$id)->get();
            $data['product'] = Product::where('id',$id)->first();
            return view('admin.products.manage_product',$data);
        })->name('product.manageProduct');

        Route::post('/manage-product/',[ProductController::class,'variant_add'])->name('add.variant');
        Route::get('/',[AdminController::class,'home'])->name('dashboard');
        Route::get('/profile',[ProfileController::class,'admin_profile'])->name('profile');

        Route::get('/user/{user}',[UserController::class,'users'])->name('users');
        Route::get('/create/user',[UserController::class,'viewCreateUser'])->name('create.user');
        Route::post('/user/create',[UserController::class,'createUser'])->name('create.user.insert');
        Route::get('/update/user-view',[UserController::class,'updateUserView'])->name('update.user.view');
        Route::post('/update/user',[UserController::class,'updateUser'])->name('user.update');
        Route::post('/drop/user',[UserController::class,'deleteUser'])->name('drop.user');
        Route::post('/active-deactive/user',[UserController::class,'active_deactive'])->name('activate.deactive.user');

        Route::get('/country',[LocationController::class,'countries'])->name('country.view')->middleware('permission:location');
        Route::get('/states',[LocationController::class,'states'])->name('states.view')->middleware('permission:location');
        Route::get('/cities',[LocationController::class,'cities'])->name('cities.view')->middleware('permission:location');

        Route::get('/stores',[StoreController::class,'stores'])->name('stores.view');
        Route::get('/create-store',[StoreController::class,'createStoreView'])->name('create.store.view');
        Route::post('/create-store',[StoreController::class,'createStore'])->name('create.store');
        Route::get('/update-store-view',[StoreController::class,'updateStoreView'])->name('update.store.view');
        Route::post('/update/store',[StoreController::class,'updateStore'])->name('store.update');
        Route::post('/drop/store',[StoreController::class,'deleteStore'])->name('drop.store');
        Route::get('/requested-stores',[StoreController::class,'requestedStore'])->name('request.store.view');

        Route::get('/sliders',[SliderController::class,'viewSliders'])->name('slider.view')->middleware('permission:slider');
        Route::get('/sliders-create',[SliderController::class,'viewCreateSlider'])->name('slider.view.create')->middleware('permission:slider');
        Route::post('/sliders-create',[SliderController::class,'createSlider'])->name('slider.create')->middleware('permission:slider');
        Route::post('/sliders-drop',[SliderController::class,'deleteSlider'])->name('drop.slider')->middleware('permission:slider');
        Route::get('/sliders-update',[SliderController::class,'viewUpdateSlider'])->name('update.slider.view')->middleware('permission:slider');
        Route::post('/sliders-update',[SliderController::class,'updateSlider'])->name('update.slider')->middleware('permission:slider');
        Route::put('/sliders-change-status',[SliderController::class,'changeStatus'])->name('slider.change.status')->middleware('permission:slider');

        Route::get('/brands',[BrandController::class,'viewBrands'])->name('brand.view');
        Route::get('/brand-create',[BrandController::class,'viewCreateBrand'])->name('brand.view.create');
        Route::post('/brand-create',[BrandController::class,'createBrand'])->name('brand.create');
        Route::post('/brand-delete',[BrandController::class,'deleteBrand'])->name('brand.delete');
        Route::post('/brand-update',[BrandController::class,'updateBrand'])->name('brand.update');
        Route::put('/brand-change-status',[BrandController::class,'changeStatus'])->name('brand.change.status');

        Route::get('/categories',[CategoryController::class,'viewCategories'])->name('category.view')->middleware(['permission:categories','permission:category']);
        Route::get('/category-create',[CategoryController::class,'viewCreateCategory'])->name('category.view.create');
        Route::post('/category-create',[CategoryController::class,'storeCategory'])->name('category.create');
        Route::post('/category-update',[CategoryController::class,'updateCategory'])->name('category.update');
        Route::post('/category-delete',[CategoryController::class,'deleteCategory'])->name('category.delete');
        Route::put('/category-change-status',[CategoryController::class,'changeStatus'])->name('category.change.status');

        Route::get('/subcategories',[SubCategoryController::class,'viewSubCategories'])->name('subcategory.view')->middleware(['permission:categories','permission:subcategory']);
        Route::get('/subcategory-create',[SubCategoryController::class,'viewSubCreateCategory'])->name('subcategory.view.create');
        Route::post('/subcategory-create',[SubCategoryController::class,'storeSubCategory'])->name('subcategory.create');
        Route::post('/subcategory-update',[SubCategoryController::class,'updateSubCategory'])->name('sub.category.update');
        Route::post('/subcategory-delete',[SubCategoryController::class,'deleteSubCategory'])->name('sub.category.delete');
        Route::put('/subcategory-change-status',[SubCategoryController::class,'changeStatus'])->name('sub.category.change.status');

        Route::get('/child-categories',[ChildCategoryController::class,'viewChildCategories'])->name('child.category.view')->middleware(['permission:categories','permission:childcategory']);
        Route::get('/child-category-create',[ChildCategoryController::class,'viewChildCreateCategory'])->name('child.category.view.create');
        Route::post('/child-category-create',[ChildCategoryController::class,'storeChildCategory'])->name('child.category.create');
        Route::post('/child-category-update',[ChildCategoryController::class,'updateChildCategory'])->name('child.category.update');
        Route::post('/child-category-delete',[ChildCategoryController::class,'deleteChildCategory'])->name('childcategory.delete');
        Route::put('/child-category-change-status',[ChildCategoryController::class,'changeStatus'])->name('child.category.change.status');


        Route::get('/products',[ProductController::class,'viewProducts'])->name('product.view');
        Route::get('/product-create',[ProductController::class,'viewCreateProduct'])->name('product.create.view');
        Route::post('/product-create',[ProductController::class,'storeProduct'])->name('product.create');
        Route::post('/product-delete',[ProductController::class,'deleteProduct'])->name('product.delete');
        Route::get('/product-edit/{product_id}',[ProductController::class,'viewEditProduct'])->name('product.edit.view');
        Route::post('/product-edit',[ProductController::class,'editProduct'])->name('product.edit');
        Route::put('/product-change-status',[ProductController::class,'changeStatus'])->name('product.change.status');

        Route::get('/product-variants/{variant_id}',[VariantController::class,'variants'])->name('product.variant.view');
        Route::get('/new-variant/{variant_id}',[VariantController::class,'addVariants'])->name('add.variant.view');
        Route::post('/new-variant/',[VariantController::class,'storeVariant'])->name('store.variant');
        Route::post('/delete-variant',[VariantController::class,'deleteVariant'])->name('delete.variant');

        Route::get('/edit-variants/{product_id}/{variant_id}',[VariantController::class,'editVariants'])->name('product.edit.variant.view');
        Route::post('/update-variants',[VariantController::class,'updateVariant'])->name('product.update.variant');

        // stock status update
        Route::put('/product-stock-status',[VariantController::class,'stockStatus'])->name('product.stock.status');



        Route::prefix('page')->group(function () {
            Route::get('/about-us', function () {
                return view('admin.pages.about');
            })->name('about.us');

            Route::post('/add-about-content',[PageController::class,'storeAbout'])->name('store.about');

            Route::get('/contact-us', function () {
                $data['contacts'] = Contact::orderBy('id','desc')->get();
                return view('admin.pages.contact',$data);
            })->name('contact.us');

            Route::post('/add-contact-content',[PageController::class,'storeContact'])->name('store.contact');

            Route::get('/policies', function () {
                return view('admin.pages.policies');
            })->name('policy');

            Route::post('/add-policy-content',[PageController::class,'storePolicy'])->name('store.policy');

            Route::get('/term-and-conditions', function () {
                return view('admin.pages.terms');
            })->name('term.and.condition');

            Route::post('/add-term-content',[PageController::class,'storeTerm'])->name('store.term');

            Route::get('/return-Refund-And-Cancellation-policy', function () {
                return view('admin.pages.RRC');
            })->name('rrc');

            Route::post('/add-return-Refund-And-Cancellation-policy-content',[PageController::class,'storeRRC'])->name('store.rrc');

        });
        // product attributes

        Route::get('product-sizes',[ProductAttributesController::class,'viewSizes'])->name('product.sizes');
        Route::post('product-add-size',[ProductAttributesController::class,'addSize'])->name('product.add.size');
        Route::post('product-update-size',[ProductAttributesController::class,'updateSize'])->name('product.update.size');
        Route::post('product-delete-size',[ProductAttributesController::class,'deleteSize'])->name('product.delete.size');
        Route::post('product-active-deactive-size',[ProductAttributesController::class,'active_deactive'])->name('product.size.active.deactive');

        Route::get('product-colors',[ProductAttributesController::class,'viewColors'])->name('product.color');
        Route::post('product-add-color',[ProductAttributesController::class,'addColor'])->name('product.add.color');
        Route::post('product-update-color',[ProductAttributesController::class,'updateColor'])->name('product.update.color');
        Route::post('product-delete-color',[ProductAttributesController::class,'deleteColor'])->name('product.delete.color');
        Route::post('product-active-deactive-color',[ProductAttributesController::class,'active_deactive_color'])->name('product.color.active.deactive');

        Route::get('product-ram-rom-sizes',[RamRomController::class,'view'])->name('ram.rom.sizes');
        Route::post('ram-rom-insert',[RamRomController::class,'store'])->name('ram.rom.store');
        Route::post('ram-rom-update',[RamRomController::class,'update'])->name('ram.rom.update');
        Route::post('ram-rom-delete',[RamRomController::class,'delete'])->name('ram.rom.delete');
        Route::post('ram-rom-status',[RamRomController::class,'active_deactive'])->name('ram.rom.change.status');


        Route::prefix('setting')->group(function () {

            Route::get('/payment-settings',[KeyController::class,'index'])->name('payment');
            Route::post('/update-paytm-setting',[KeyController::class,'updatePaytm'])->name('update.paytm.settings');

            Route::post('/update-razorpay-setting',[KeyController::class,'updaterazorpay'])->name('update.razorpay.settings');
            Route::post('/update-stripe-setting',[KeyController::class,'updateStripe'])->name('update.stripe.settings');

            Route::get('/mail-setting',[SettingController::class,'mailSetting'])->name('mail.setting');
            Route::post('/mail-update',[SettingController::class,'mailUpdate'])->name('mail.update');

            Route::get('/site-setting',[SiteSettingController::class,'view'])->name('site.setting.view');

            Route::post('/update-site-details',[SiteSettingController::class,"updateDetails"])->name('update.site.details');
            Route::post('/update-logo',[SiteSettingController::class,"logo"])->name('update.site.logo');
            Route::post('/update-favicon',[SiteSettingController::class,"updateFavicon"])->name('update.site.favicon');

        });


        Route::get('/drivers',[DriverController::class,'home'])->name('driver.view');
        Route::get('/add-driver',[DriverController::class,'add_driver'])->name('add.driver.view');
        Route::post('/add-driver',[DriverController::class,'storeDriver'])->name('add.driver');
        Route::post('/drop-driver',[DriverController::class,'deleteDriver'])->name('delete.driver');
        Route::post('/driver/active-deactive',[DriverController::class,'active_deactive'])->name('driver.active.deactive');

        Route::prefix('order')->group(function () {
            Route::get('/all',[OrderController::class,'all'])->name('all.orders');
            Route::get('/pending',[OrderController::class,'pending'])->name('pending.orders');
            Route::get('/cancel',[OrderController::class,'cancel'])->name('cancel.orders');
            Route::get('/return',[OrderController::class,'returnOrders'])->name('return.orders');
            Route::get('/view-order/{order_id}',[OrderController::class,'viewOrder'])->name('view.orders');
        });
        Route::prefix('coupon')->group(function () {
            Route::get('/',[CouponController::class,'view'])->name('coupons');
            Route::get('/add-coupon',[CouponController::class,'viewCreate'])->name('view.add.coupon');
            Route::post('/add-coupon',[CouponController::class,'addCoupon'])->name('add.coupon');
            Route::get('/active-deactive',[CouponController::class,'active_deactive'])->name('coupon.active.deactive');
            Route::post('/drop-coupon',[CouponController::class,'deleteCoupon'])->name('delete.coupon');
            Route::get('/edit-coupon/{coupon_id}',[CouponController::class,'viewEditCoupon'])->name('view.edit.coupon');
            Route::post('/edit-coupon/{coupon_id}',[CouponController::class,'editCoupon'])->name('edit.coupon');
        });

        // shipping settings
        Route::get('/shipping',[ShippingController::class,'view'])->name('shipping');
        Route::post('/shipping',[ShippingController::class,'post'])->name('update.shipping');

    });

    Route::group(['middleware'=>'role:admin','prefix'=>'subadmin','as'=>'admin'],function () {
        Route::get('/', function () {
            return view('subadmin.home');
        })->name('dashboard');

    });

    Route::group(['middleware'=>'role:seller','prefix'=>'seller','as'=>'seller.'],function () {
            // Route::get('/', function () {
            //     return view('seller.home');
            // })->name('dashboard');

        Route::get('/',[SellerController::class,'home'])->name('dashboard');

        Route::get('/customers',[SellerDriverController::class,"customers"])->name('customers');
        Route::get('/add-customers',[SellerDriverController::class,"viewAddCustomer"])->name('view.add.customers');
        Route::post('/add-customers',[SellerDriverController::class,"addCustomer"])->name('add.customers');
        Route::post('/active-deactive/customer',[SellerDriverController::class,'active_deactive'])->name('activate.deactive.customer');

        Route::get('/products',[SellerProductController::class,'viewProducts'])->name('product.view');
        Route::get('/product-create',[SellerProductController::class,'viewCreateProduct'])->name('product.create.view');
        Route::post('/product-create',[SellerProductController::class,'storeProduct'])->name('product.create');
        Route::post('/product-delete',[SellerProductController::class,'deleteProduct'])->name('product.delete');

        Route::get('/brands',[SellerBrandController::class,'viewBrands'])->name('brand.view');
        Route::get('/brand-create',[SellerBrandController::class,'viewCreateBrand'])->name('brand.view.create');
        Route::post('/brand-create',[SellerBrandController::class,'createBrand'])->name('brand.create');
        Route::post('/brand-delete',[SellerBrandController::class,'deleteBrand'])->name('brand.delete');
        // Route::post('/brand-update',[SellerBrandController::class,'deleteBrand'])->name('brand.view.update');

        Route::prefix('order')->group(function () {
            Route::get('/all',[SellerOrderController::class,'all'])->name('all.orders');
            Route::get('/pending',[SellerOrderController::class,'pending'])->name('pending.orders');
            Route::get('/cancel',[SellerOrderController::class,'cancel'])->name('cancel.orders');
            Route::get('/return',[SellerOrderController::class,'returnOrders'])->name('return.orders');
            Route::get('/view-order/{order_id}',[SellerOrderController::class,'viewOrder'])->name('view.orders');

        });

        Route::get('/stores',[SellerStoreController::class,'stores'])->name('stores.view');
        Route::get('/create-store',[SellerStoreController::class,'createStoreView'])->name('create.store.view');
        Route::post('/create-store',[SellerStoreController::class,'createStore'])->name('create.store');
        Route::get('/update-store-view',[SellerStoreController::class,'updateStoreView'])->name('update.store.view');
        Route::post('/update/store',[SellerStoreController::class,'updateStore'])->name('store.update');
        Route::post('/drop/store',[SellerStoreController::class,'deleteStore'])->name('drop.store');

        Route::get('/drivers',[SellerDriverController::class,'viewDrivers'])->name('driver.view');
        Route::get('/add-driver',[SellerDriverController::class,'add_driver'])->name('add.driver.view');
        Route::post('/add-driver',[SellerDriverController::class,'storeDriver'])->name('add.driver');
        Route::post('/delete-driver',[SellerDriverController::class,'deleteDriver'])->name('delete.driver');
        Route::post('/driver/active-deactive',[SellerDriverController::class,'active_deactive_driver'])->name('driver.active.deactive');

    });

    Route::group(['middleware'=>'role:user','as'=>'user'],function () {

    });

    Route::post('/assign-order',[AssignController::class,'assignOrder'])->name('assign.order');
});



Route::get('/config-clear', function () {
    Artisan::call('config:clear');
    return "config clear successfully";
});

Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return "config cache successfully clear";
});

Route::get('/cache', function () {
    Artisan::call('cache:clear');

    return "cache clear successfully";
});

Route::get('/route-cache', function () {
    Artisan::call('route:cache');
    return "route cache successfully clear";
});

Route::get('/route-clear', function () {
    Artisan::call('route:clear');

    return "route clear successfully";
});

require __DIR__.'/auth.php';
