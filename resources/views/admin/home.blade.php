@extends('layouts.adminBase')
@section('title','Admin | homepage')
@section('content')

    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
    <div class="col">
            <div class="card radius-10 overflow-hidden bg-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Orders</p>
                            <h5 class="mb-0 text-white">{{ order_count()->count() }}</h5>
                        </div>
                        <div class="ms-auto text-white">	<i class='bx bx-cart font-30'></i>
                        </div>
                    </div>
                </div>
                <div class="" id="chart1"></div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 overflow-hidden bg-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Income</p>
                            <h5 class="mb-0 text-white">₹ 52,945</h5>
                        </div>
                        <div class="ms-auto text-white">	<i class='bx bx-wallet font-30'></i>
                        </div>
                    </div>
                </div>
                <div class="" id="chart2"></div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 overflow-hidden bg-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-dark">Total Users</p>
                            <h5 class="mb-0 text-dark">{{ $users->count() }}</h5>
                        </div>
                        <div class="ms-auto text-dark">	<i class='bx bx-group font-30'></i>
                        </div>
                    </div>
                </div>
                <div class="" id="chart3"></div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 overflow-hidden bg-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Reviews</p>
                            <h5 class="mb-0 text-white">{{ review_count()->count() }}</h5>
                        </div>
                        <div class="ms-auto text-white">	<i class='bx bx-chat font-30'></i>
                        </div>
                    </div>
                </div>
                <div class="" id="chart4"></div>
            </div>
        </div>
    </div><!--end row-->


    {{-- <div class="row">
    <div class="col-12 col-xl-8 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="" id="chart5"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Sales Target</h5>
                        </div>
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                <div class="mt-4" id="chart6"></div>
                <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0">2248</h2>
                            <p class="mb-0">/2,800 target</p>
                        </div>
                        <div class="ms-auto d-flex align-items-center border radius-10 px-2">
                            <i class='bx bxs-checkbox font-22 me-1 text-primary'></i><span>Marketing Sales</span>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div> --}}

    <!--end row-->


    {{-- <div class="row row-cols-1 row-cols-xl-2">
    <div class="col d-flex">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="" id="chart7"></div>
            </div>
        </div>
    </div>
    <div class="col d-flex">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-1">Sales Report</h5>
                    </div>
                    <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                    </div>
                </div>
                <div class="" id="chart8"></div>
            </div>
        </div>
    </div>
    </div> --}}

    <!--end row-->

    {{-- <div class="row">
    <div class="col-12 col-xl-4 col-xxl-3 d-flex">
        <div class="card radius-10 w-100 overflow-hidden">
            <div class="card-body">
                <p class="mb-1">Overall Sales Performance</p>
                <div class="">
                    <h2 class="mb-0">$84,126.5</h2>
                    <p class="mb-0 text-success">+2.5% vs last month</p>
                </div>
            </div>
            <div class="" id="chart9"></div>
        </div>
    </div>
    <div class="col-12 col-xl-8 col-xxl-9 d-flex">
        <div class="card w-100 radius-10">
            <div class="row g-0">
                <div class="col-md-4 border-end">
                <div class="card-body">
                    <h5 class="card-title">Top Sales Locations</h5>
                    <h2 class="mt-4 mb-1">25.860 <i class="flag-icon flag-icon-us rounded"></i></h2>
                    <p class="mb-0 text-secondary">Our Most Customers in US</p>
                </div>
                <ul class="list-group mt-4 list-group-flush">
                    <li class="list-group-item d-flex align-items-center">
                        <i class='bx bxs-circle me-1 text-success'></i>
                        <span>Massive</span>
                        <strong class="ms-auto">18.4k</strong>
                    </li>
                    <li class="list-group-item d-flex align-items-center">
                        <i class='bx bxs-circle me-1 text-danger'></i>
                        <span>Large</span>
                        <strong class="ms-auto">6.9k</strong>
                    </li>
                    <li class="list-group-item d-flex align-items-center">
                        <i class='bx bxs-circle me-1 text-primary'></i>
                        <span>Medium</span>
                        <strong class="ms-auto">5.4k</strong>
                    </li>
                    <li class="list-group-item d-flex align-items-center">
                        <i class='bx bxs-circle me-1 text-warning'></i>
                        <span>Small</span>
                        <strong class="ms-auto">875</strong>
                    </li>
                </ul>
                </div>
                <div class="col-md-8">
                    <div class="p-3">
                    <div class="" id="geographic-map"></div>
                    </div>
                </div>
            </div>
            </div>
    </div>
    </div> --}}

    <!--end row-->

    <div class="row">
        <div class="col-12 col-xl-4 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">New Customers</h5>
                    </div>
                    <div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
                    </div>
                </div>
            </div>
            <div class="customers-list p-3 mb-3">
                @foreach (new_users('user') as $user)
                <div class="customers-list-item d-flex align-items-center border-top border-bottom p-2 cursor-pointer">
                    <div class="">
                        <img src="{{ asset('users/images/'.$user->image) }}" class="rounded-circle" width="46" height="46" alt="" />
                    </div>
                    <div class="ms-2">
                        <h6 class="mb-1 font-14">{{ $user->user_name }}</h6>
                        <p class="mb-0 font-13 text-secondary">{{ $user->email }}</p>
                    </div>
                    <div class="list-inline d-flex customers-contacts ms-auto">	<a href="mailto:{{ $user->email }}" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                        <a href="tel:{{ $user->phone }}" class="list-inline-item"><i class='bx bxs-phone' ></i></a>
                        {{-- <a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a> --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
        <div class="col-12 col-xl-4 d-flex">
        <div class="card radius-10 w-100 overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Store Metrics</h5>
                    </div>
                    <div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
                    </div>
                </div>
            </div>

            <div class="store-metrics p-3 mb-3">

                <div class="card mt-3 radius-10 border shadow-none">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Products</p>
                                <h4 class="mb-0">{{ $products->count() }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-primary text-primary ms-auto"><i class='bx bxs-shopping-bag' ></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card radius-10 border shadow-none">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Customers</p>
                                <h4 class="mb-0">{{ new_users('user')->count() }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-group' ></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card radius-10 border shadow-none">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Categories</p>
                                <h4 class="mb-0">{{ $categories->count() }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-category' ></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card radius-10 border shadow-none">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Orders</p>
                                <h4 class="mb-0">{{ order_count()->count() }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bxs-cart-add' ></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card radius-10 border shadow-none mb-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Vendors</p>
                                <h4 class="mb-0">{{ new_users('seller')->count() }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='bx bxs-user-account' ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="col-12 col-xl-4 d-flex">
        <div class="card radius-10 w-100 ">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-1">Top Products</h5>
                    </div>
                    <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                    </div>
                </div>
            </div>

            <div class="product-list p-3 mb-3">
                @foreach (product_count() as $product)
                <div class="d-flex align-items-center py-3 border-bottom cursor-pointer">
                    <div class="product-img me-2">
                            <img src="{{ asset('images/products/'.$product->image) }}" alt="product img">
                        </div>
                    <div class="">
                        <h6 class="mb-0 font-14">{{ $product->name }}</h6>
                        <p class="mb-0">₹<del>{{ $product->price }}</del></p>
                    </div>
                    <div class="ms-auto">
                        <h6 class="mb-0">₹ {{ $product->price }}</h6>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>

    <!--end row-->


    <div class="row">
        <div class="col">
            <div class="card radius-10 mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Recent Orders</h5>
                        </div>
                        <div class="ms-auto">
                            <a href="{{ route('super.admin.all.orders') }}" class="btn btn-primary btn-sm radius-30">View All Orders</a>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tracking ID</th>
                                    <th>Products Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (order_count() as $order)
                                <tr>
                                    <td>#OR{{ $order->id }}</td>
                                    <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="{{ asset('images/products/'.$order->cartItems->image) }}" alt="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">{{ $order->cartItems->name }}</h6>
                                        </div>
                                    </div>
                                    </td>
                                    <td>{{ $order->created_at }}</td>
                                    <td class="">
                                        @if ($order->status ==3)
                                        <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Canceled</div>
                                        @endif
                                    </td>
                                    <td>₹ {{ $order->cartItems->offer_price }}</td>
                                    <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{ route('super.admin.view.orders',['order_id'=>$order->id]) }}" class=""><i class='lni lni-eye'></i></a>
                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--end row-->


    @section('js')
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<script src="{{ asset('assets/plugins/highcharts/js/highcharts.js') }}"></script>
	<script src="{{ asset('assets/plugins/highcharts/js/exporting.js') }}"></script>
	<script src="{{ asset('assets/plugins/highcharts/js/variable-pie.js') }}"></script>
	<script src="{{ asset('assets/plugins/highcharts/js/export-data.js') }}"></script>
	<script src="{{ asset('assets/plugins/highcharts/js/accessibility.js') }}"></script>
	<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    @endsection
@endsection
