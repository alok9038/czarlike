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
        @if (permissions()->dashboard == 1)
        <li class="@yield('menu')">
            <a href="{{ route('seller.dashboard') }}">
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
                <li class="@yield('customer_select')"><a href="{{ route('seller.customers') }}"><i class="bx bx-radio-circle-marked"></i>All Customers</a></li>
                @endif
                @if (permissions()->seller == 1)
                <li class="@yield('seller_select')"><a href="{{ route('super.admin.users',['user'=>'seller']) }}"><i class="bx bx-radio-circle-marked"></i>All Sellers</a></li>
                @endif
                {{-- @if (permissions()->admin == 1)
                <li class="@yield('admin_select')"><a href="{{ route('super.admin.users',['user'=>'admin']) }}"><i class="bx bx-radio-circle-marked"></i>All Admin</a></li>
                @endif --}}
            </ul>
        </li>
        @endif
        <li class="@yield('menu')">
            <a href="{{ route('seller.driver.view') }}">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Driver Manager</div>
            </a>
        </li>
        @if (permissions()->create_store == 1)
        <li class="@yield('menu')">
            <a href="{{ route('seller.stores.view') }}">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Stores</div>
            </a>
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
                <li class="@yield('brand-select')"><a href="{{ route('seller.brand.view') }}"><i class="bx bx-radio-circle-marked"></i>Brands</a></li>
                @endif
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
                    <li class="@yield('product-select')"><a href="{{ route('seller.product.view') }}"><i class="bx bx-radio-circle-marked"></i>Products</a></li>
                @endif
            </ul>
        </li>
        @endif
        <li class='@yield('orders')'>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Orders & Invoice</div>
            </a>
            <ul>
                <li class="@yield('all_orders')"><a href="{{ route('seller.all.orders') }}"><i class="bx bx-radio-circle-marked"></i>All Orders</a></li>
                <li class="@yield('pending_orders')"><a href="{{ route('seller.pending.orders') }}"><i class="bx bx-radio-circle-marked"></i>Pending Orders</a></li>
                <li class="@yield('canceled_orders')"><a href="{{ route('seller.cancel.orders') }}"><i class="bx bx-radio-circle-marked"></i>Canceled Orders</a></li>
                <li class="@yield('returned_orders')"><a href="{{ route('seller.return.orders') }}"><i class="bx bx-radio-circle-marked"></i>Returned Orders</a></li>
                {{-- <li><a href="#"><i class="bx bx-radio-circle-marked"></i>Invoice Setting</a></li> --}}
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
        <li>
            <a href="{{ route('profile') }}">
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
