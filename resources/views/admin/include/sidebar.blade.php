<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            {{-- <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon"> --}}
        </div>
        <div>
            <h4 class="logo-text">Ecommerce</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="@yield('menu')">
            <a href="{{ route('super.admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bxs-dashboard'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li class="@yield('user_select')">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Users</div>
            </a>
            <ul>
                <li class="@yield('customer_select')"><a href="{{ route('super.admin.users',['user'=>'customer']) }}"><i class="bx bx-radio-circle-marked"></i>All Customers</a></li>
                <li class="@yield('seller_select')"><a href="{{ route('super.admin.users',['user'=>'seller']) }}"><i class="bx bx-radio-circle-marked"></i>All Sellers</a></li>
                <li class="@yield('admin_select')"><a href="{{ route('super.admin.users',['user'=>'admin']) }}"><i class="bx bx-radio-circle-marked"></i>All Admin</a></li>
            </ul>
        </li>
        <li class="@yield('driver_select')">
            <a href="{{ route('super.admin.driver.view') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Driver Manager</div>
            </a>
        </li>

        <li class="@yield('stores_select')">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Stores</div>
            </a>
            <ul>
                <li class="@yield('stores')"><a href="{{ route('super.admin.stores.view') }}"><i class="bx bx-radio-circle-marked"></i>Stores</a></li>
                <li class="@yield('stores_request')"><a href="{{ route('super.admin.request.store.view') }}"><i class="bx bx-radio-circle-marked"></i>Stores Requests <span class="badge bg-danger ms-auto rounded-pill">{{ store_request()->count() }}</span></a> </li>
            </ul>
        </li>
        <li class="@yield('product_management')">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bxl-product-hunt'></i>
                </div>
                <div class="menu-title">Product Management</div>
            </a>
            <ul>
                <li class="@yield('brand-select')"><a href="{{ route('super.admin.brand.view') }}"><i class="bx bx-radio-circle-marked"></i>Brands</a></li>
                <li class="@yield('requested_brand-select')"><a href="#"><i class="bx bx-radio-circle-marked"></i>Requested Brands</a></li>
                <li class="@yield('category-select')">
                    <a href="#" class="has-arrow"><i class="bx bx-radio-circle-marked"></i>Categories</a>
                    <ul>
                        <li class="@yield('categories-select')"> <a href="{{ route('super.admin.category.view') }}"><i class="bx bx-radio-circle-marked"></i>Categories</a></li>
                        <li class=""> <a href="{{ route('super.admin.subcategory.view') }}"><i class="bx bx-radio-circle-marked"></i>SubCategories</a></li>
                        <li class="@yield('child_category')"> <a href="{{ route('super.admin.child.category.view') }}"><i class="bx bx-radio-circle-marked"></i>ChildCategories</a></li>
                    </ul>
                </li>
                <li class="@yield('product-select')"><a href="{{ route('super.admin.product.view') }}"><i class="bx bx-radio-circle-marked"></i>Products</a></li>
                {{-- <li class="@yield('import_product-select')"><a href="#"><i class="bx bx-radio-circle-marked"></i>Import Products</a></li> --}}
                <li class="@yield('product_attributes-select')">
                    <a href="#" class="has-arrow"><i class="bx bx-radio-circle-marked"></i>Product Attributes</a>
                    <ul>
                        <li class="@yield('color')"> <a href="{{ route('super.admin.product.color') }}"><i class="bx bx-radio-circle-marked"></i>Color Manager</a></li>
                        <li class="@yield('size')"> <a href="{{ route('super.admin.product.sizes') }}"><i class="bx bx-radio-circle-marked"></i>Size Manager</a></li>
                        <li class="@yield('ram_rom')"> <a href="{{ route('super.admin.ram.rom.sizes') }}"><i class="bx bx-radio-circle-marked"></i>Ram - Rom Manager</a></li>

                    </ul>
                </li>
                <li class="@yield('coupons-select')"><a href="{{ route('super.admin.coupons') }}"><i class="bx bx-radio-circle-marked"></i>Coupons</a></li>
                {{-- <li class="@yield('return-select')"><a href="#"><i class="bx bx-radio-circle-marked"></i>Return policy</a></li>
                <li class="@yield('units-select')"><a href="#"><i class="bx bx-radio-circle-marked"></i>Units</a></li> --}}

            </ul>
        </li>
        <li class='@yield('orders')'>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Orders & Invoice</div>
            </a>
            <ul>
                <li class="@yield('all_orders')"><a href="{{ route('super.admin.all.orders') }}"><i class="bx bx-radio-circle-marked"></i>All Orders</a></li>
                <li class="@yield('pending_orders')"><a href="{{ route('super.admin.pending.orders') }}"><i class="bx bx-radio-circle-marked"></i>Pending Orders</a></li>
                <li class="@yield('canceled_orders')"><a href="{{ route('super.admin.cancel.orders') }}"><i class="bx bx-radio-circle-marked"></i>Canceled Orders</a></li>
                <li class="@yield('returned_orders')"><a href="{{ route('super.admin.return.orders') }}"><i class="bx bx-radio-circle-marked"></i>Returned Orders</a></li>
                <li><a href="#"><i class="bx bx-radio-circle-marked"></i>Invoice Setting</a></li>
            </ul>
        </li>
        <li class="@yield('rating')">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Review & Ratings</div>
            </a>
            <ul>
                <li><a href="#"><i class="bx bx-radio-circle-marked"></i>All Review</a></li>
                <li><a href="#"><i class="bx bx-radio-circle-marked"></i>Reviews For Approval</a></li>
            </ul>
        </li>
        <li class="@yield('site_setting')">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-cog"></i>
                </div>
                <div class="menu-title">Site Settings</div>
            </a>
            <ul>
                <li class="@yield('general_setting')"><a href="{{ route('super.admin.site.setting.view') }}"><i class="bx bx-radio-circle-marked"></i>General Settings</a></li>
                <li class="@yield('mail_setting')"><a href="{{ route('super.admin.mail.setting') }}"><i class="bx bx-radio-circle-marked"></i>Mail Settings</a></li>
            </ul>
        </li>
        {{-- <li class="menu-label">Forms & Tables</li> --}}
        <li class="@yield('payment_select')">
            <a href="{{ route('super.admin.payment') }}">
                <div class="parent-icon"><i class="bx bx-credit-card"></i>
                </div>
                <div class="menu-title">Payment Settings</div>
            </a>
        </li>
        <li class="@yield('shipping')">
            <a href="{{ route('super.admin.shipping') }}">
                <div class="parent-icon"><i class="bx bxs-plane"></i>
                </div>
                <div class="menu-title">Shipping Settings</div>
            </a>
        </li>

        <li class="@yield('pages_select')">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-map"></i>
                </div>
                <div class="menu-title">Pages</div>
            </a>
            <ul>
                <li class="@yield('about_us')"><a href="{{ route('super.admin.about.us') }}"><i class="bx bx-radio-circle-marked"></i>About us</a></li>
                <li class="@yield('contact_us')"><a href="{{ route('super.admin.contact.us') }}"><i class="bx bx-radio-circle-marked"></i>Contact us</a></li>
                <li class="@yield('policies')"><a href="{{ route('super.admin.policy') }}"><i class="bx bx-radio-circle-marked"></i>Policies</a></li>
                <li class="@yield('t&c')"><a href="{{ route('super.admin.term.and.condition') }}"><i class="bx bx-radio-circle-marked"></i>Terms & conditions</a></li>
                <li class="@yield('rrc')"><a href="{{ route('super.admin.rrc') }}"><i class="bx bx-radio-circle-marked"></i>Return Refund & Cancellation</a></li>
                {{-- <li class="@yield('return_policy')"><a href="{{ route('super.admin.cities.view') }}"><i class="bx bx-radio-circle-marked"></i>Return policy</a></li> --}}
            </ul>
        </li>

        <li class="@yield('location')">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-map"></i>
                </div>
                <div class="menu-title">Locations</div>
            </a>
            <ul>
                <li class="@yield('country')"><a href="{{ route('super.admin.country.view') }}"><i class="bx bx-radio-circle-marked"></i>Country</a></li>
                <li class="@yield('state')"><a href="{{ route('super.admin.states.view') }}"><i class="bx bx-radio-circle-marked"></i>State</a></li>
                <li class="@yield('city')"><a href="{{ route('super.admin.cities.view') }}"><i class="bx bx-radio-circle-marked"></i>City</a></li>
                <li><a href="#"><i class="bx bx-radio-circle-marked"></i>Deliver Locations</a></li>
            </ul>
        </li>
        {{-- <li class="menu-label">Pages</li> --}}
        <li class="@yield('commision')">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-pie-chart-alt-2"></i>
                </div>
                <div class="menu-title">Commision</div>
            </a>
            <ul>
                <li><a href="#"><i class="bx bx-radio-circle-marked"></i>Commision Settings</a></li>
            </ul>
        </li>
        <li class="@yield('sliders')">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-slider-alt"></i>
                </div>
                <div class="menu-title">Sliders</div>
            </a>
            <ul>
                <li class="slider_select"><a href="{{ route('super.admin.slider.view') }}"><i class="bx bx-radio-circle-marked"></i>Slider</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('super.admin.profile') }}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Profile</div>
            </a>
        </li>
        <li>
            <a href="#" onclick="javascript:$('#logout_form').submit();">
                <div class="parent-icon"><i class="bx bx-power-off text-danger"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
