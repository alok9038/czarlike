<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <h4 class="logo-text">Ecommerce</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if (permissions()->dashboard == 1)
        <li class="@yield('menu')">
            <a href="{{ route('super.admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bxs-dashboard'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @endif

        @if (permissions()->manage_users == 1)
        <li class="@yield('user_select')">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Users</div>
            </a>
            <ul>
                @if (permissions()->customers == 1)
                <li class="@yield('customer_select')"><a href="{{ route('super.admin.users',['user'=>'customer']) }}"><i class="bx bx-radio-circle-marked"></i>All Customers</a></li>
                @endif
                @if (permissions()->sellers == 1)
                <li class="@yield('seller_select')"><a href="{{ route('super.admin.users',['user'=>'seller']) }}"><i class="bx bx-radio-circle-marked"></i>All Sellers</a></li>
                @endif
                @if (permissions()->admin == 1)
                <li class="@yield('admin_select')"><a href="{{ route('super.admin.users',['user'=>'admin']) }}"><i class="bx bx-radio-circle-marked"></i>All Admin</a></li>
                @endif
            </ul>
        </li>
        @endif
        <li class="@yield('driver_select')">
            <a href="{{ route('super.admin.driver.view') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Driver Manager</div>
            </a>
        </li>
        {{-- @if (permissions()->menu_management == 1)
        <li class="@yield('menu')">
            <a href="widgets.html">
                <div class="parent-icon"><i class='bx bx-menu'></i>
                </div>
                <div class="menu-title">Menu Management</div>
            </a>
        </li>
        @endif --}}
        @if (permissions()->create_store == 1)
        <li class="@yield('stores_select')">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Stores</div>
            </a>
            <ul>
                <li class="@yield('stores')"><a href="{{ route('super.admin.stores.view') }}"><i class="bx bx-radio-circle-marked"></i>Stores</a></li>
                <li class="@yield('stores_request')"><a href="{{ route('super.admin.request.store.view') }}"><i class="bx bx-radio-circle-marked"></i>Stores Requests</a></li>
            </ul>
        </li>
        @endif
        @if (permissions()->product_manage == 1)
        <li class="@yield('product_management')">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bxl-product-hunt'></i>
                </div>
                <div class="menu-title">Product Management</div>
            </a>
            <ul>
                @if (permissions()->brand == 1)
                <li class="@yield('brand-select')"><a href="{{ route('super.admin.brand.view') }}"><i class="bx bx-radio-circle-marked"></i>Brands</a></li>
                @endif
                {{-- @if (permissions()->product_manage == 1)
                <li class="@yield('requested_brand-select')"><a href="#"><i class="bx bx-radio-circle-marked"></i>Requested Brands</a></li>
                @endif --}}
                @if (permissions()->categories_manage == 1)
                <li class="@yield('category-select')">
                    <a href="#" class="has-arrow"><i class="bx bx-radio-circle-marked"></i>Categories</a>
                    <ul>
                        @if (permissions()->category == 1)
                        <li class="@yield('categories-select')"> <a href="{{ route('super.admin.category.view') }}"><i class="bx bx-radio-circle-marked"></i>Categories</a></li>
                        @endif
                        @if (permissions()->sub_category == 1)
                        <li class=""> <a href="{{ route('super.admin.subcategory.view') }}"><i class="bx bx-radio-circle-marked"></i>SubCategories</a></li>
                        @endif
                        @if (permissions()->child_category == 1)
                        <li class="@yield('child_category')"> <a href="{{ route('super.admin.child.category.view') }}"><i class="bx bx-radio-circle-marked"></i>ChildCategories</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (permissions()->products == 1)
                <li class="@yield('product-select')"><a href="{{ route('super.admin.product.view') }}"><i class="bx bx-radio-circle-marked"></i>Products</a></li>
                @endif

                @if (permissions()->coupons == 1)
                <li class="@yield('coupons-select')"><a href="{{ route('super.admin.coupons') }}"><i class="bx bx-radio-circle-marked"></i>Coupons</a></li>
                @endif
            </ul>
        </li>
        @endif
        @if (permissions()->orders == 1)
        <li class='@yield('orders')'>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Orders & Invoice</div>
            </a>
            <ul>
                @if (permissions()->all_orders == 1)
                <li class="@yield('all_orders')"><a href="{{ route('super.admin.all.orders') }}"><i class="bx bx-radio-circle-marked"></i>All Orders</a></li>
                @endif
                @if (permissions()->pending_orders == 1)
                <li class="@yield('pending_orders')"><a href="{{ route('super.admin.pending.orders') }}"><i class="bx bx-radio-circle-marked"></i>Pending Orders</a></li>
                @endif
                @if (permissions()->cancel_orders == 1)
                <li class="@yield('canceled_orders')"><a href="{{ route('super.admin.cancel.orders') }}"><i class="bx bx-radio-circle-marked"></i>Canceled Orders</a></li>
                @endif
                @if (permissions()->return_orders == 1)
                <li class="@yield('returned_orders')"><a href="{{ route('super.admin.return.orders') }}"><i class="bx bx-radio-circle-marked"></i>Returned Orders</a></li>
                @endif
                @if (permissions()->invoice_orders == 1)
                <li><a href="#"><i class="bx bx-radio-circle-marked"></i>Invoice Setting</a></li>
                @endif
            </ul>
        </li>
        @endif
        @if (permissions()->ratings == 1)
        <li class="@yield('rating')">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Review & Ratings</div>
            </a>
            <ul>
                {{-- @if (permissions()->all_review == 1) --}}
                <li><a href="#"><i class="bx bx-radio-circle-marked"></i>All Review</a></li>
                {{-- @endif
                @if (permissions()->review_approval == 1) --}}
                <li><a href="#"><i class="bx bx-radio-circle-marked"></i>Reviews For Approval</a></li>
                {{-- @endif --}}
            </ul>
        </li>
        @endif
        @if (permissions()->locations == 1)
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
        @endif
        {{-- <li class="menu-label">Pages</li> --}}
        {{-- <li class="@yield('commision')">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-pie-chart-alt-2"></i>
                </div>
                <div class="menu-title">Commision</div>
            </a>
            <ul>
                <li><a href="#"><i class="bx bx-radio-circle-marked"></i>Commision Settings</a></li>
            </ul>
        </li> --}}
        {{-- @if (permissions()->slider == 1)
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
        @endif --}}
        <li>
            <a href="{{ route('super.admin.profile') }}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Profile</div>
            </a>
        </li>
        {{-- <li>
            <a href="timeline.html">
                <div class="parent-icon"> <i class="bx bx-video-recording"></i>
                </div>
                <div class="menu-title">Timeline</div>
            </a>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-error"></i>
                </div>
                <div class="menu-title">Errors</div>
            </a>
            <ul>
                <li> <a href="errors-404-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>404 Error</a>
                </li>
                <li> <a href="errors-500-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>500 Error</a>
                </li>
                <li> <a href="errors-coming-soon.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Coming Soon</a>
                </li>
                <li> <a href="error-blank-page.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Blank Page</a>
                </li>
            </ul>
        </li> --}}
        {{-- <li>
            <a href="faq.html">
                <div class="parent-icon"><i class="bx bx-help-circle"></i>
                </div>
                <div class="menu-title">FAQ</div>
            </a>
        </li>
        <li>
            <a href="pricing-table.html">
                <div class="parent-icon"><i class="bx bx-diamond"></i>
                </div>
                <div class="menu-title">Pricing</div>
            </a>
        </li>
        <li class="menu-label">Charts & Maps</li> --}}
        {{-- <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Charts</div>
            </a>
            <ul>
                <li> <a href="charts-apex-chart.html"><i class="bx bx-right-arrow-alt"></i>Apex</a>
                </li>
                <li> <a href="charts-chartjs.html"><i class="bx bx-right-arrow-alt"></i>Chartjs</a>
                </li>
                <li> <a href="charts-highcharts.html"><i class="bx bx-right-arrow-alt"></i>Highcharts</a>
                </li>
            </ul>
        </li> --}}
        {{-- <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-map-alt"></i>
                </div>
                <div class="menu-title">Maps</div>
            </a>
            <ul>
                <li> <a href="map-google-maps.html"><i class="bx bx-right-arrow-alt"></i>Google Maps</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bx bx-right-arrow-alt"></i>Vector Maps</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Others</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-menu"></i>
                </div>
                <div class="menu-title">Menu Levels</div>
            </a>
            <ul>
                <li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level One</a>
                    <ul>
                        <li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Two</a>
                            <ul>
                                <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Three</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li> --}}
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
