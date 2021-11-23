@extends('layouts.sellerBase')
@section('content')
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 overflow-hidden bg-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Orders</p>
                            <h5 class="mb-0 text-white">{{ $orders->count() }}</h5>
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
                            <h5 class="mb-0 text-white">$52,945</h5>
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
    </div>

    {{--  --}}
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
                @foreach ($users as $user)
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
                                <h4 class="mb-0">{{ $users->count() }}</h4>
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
                                <p class="mb-0 text-secondary">Total Orders</p>
                                <h4 class="mb-0">{{ order_count()->count() }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bxs-cart-add' ></i>
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
                @foreach ( $products as $product)
                <div class="d-flex align-items-center py-3 border-bottom cursor-pointer">
                    <div class="product-img me-2">
                            <img src="{{ asset('images/products/'.$product->image) }}" alt="product img">
                        </div>
                    <div class="">
                        <h6 class="mb-0 font-14">{{ $product->name }}</h6>
                        <p class="mb-0">148 Sales</p>
                    </div>
                    <div class="ms-auto">
                        <h6 class="mb-0">₹ {{ $product->offer_price }}</h6>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>
@endsection
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
