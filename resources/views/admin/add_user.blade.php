@extends('layouts.adminBase')
@section('title','All users | Admin')
@section('user_select','mm-active')
@section('content')
    <div class="container my-3">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Add User</h4>
                <span class="ms-auto"><a href="#" class="btn btn-secondary btn-sm"><i class="bx bx-left-arrow"></i>Back</a></span>
            </div>
            <div class="card-body">
                <form action="{{ route('super.admin.create.user.insert') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col">
                            <label class="fw-bold" for="user_name">User Name <span class="text-danger small"><sup>*</sup></span></label>
                            <input type="text" id="user_name" name="name" value="{{ old('name') }}" placeholder="  please enter user name" class="form-control shadow-none @error('name') is-invalid @enderror">
                            @error('name')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col">
                            <label class="fw-bold" for="email">Email <span class="text-danger small"><sup>*</sup></span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="  please enter user email" class="form-control shadow-none @error('email') is-invalid @enderror">
                            @error('email')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label class="fw-bold" for="password">Password<span class="text-danger small"><sup>*</sup></span></label>
                            <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="  please enter user password" class="form-control shadow-none @error('password') is-invalid @enderror">
                            @error('password')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col">
                            <label class="fw-bold" for="password_confirmation">Confirm Password <span class="text-danger small"><sup>*</sup></span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"  class="form-control shadow-none @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label class="fw-bold" for="phone">Phone number <span class="text-danger small">*</span></label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="  please enter user phone number" class="form-control shadow-none @error('phone') is-invalid @enderror">
                            @error('phone')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col">
                            <label class="fw-bold" for="image">Profile Image</label>
                            <input type="file" id="image" name="image"  class="form-control shadow-none @error('image') is-invalid @enderror">
                            @error('image')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label class="fw-bold" for="country">Country</label>
                            <select name="country" class="form-control shadow-none @error('country') is-invalid @enderror" id="country-dd">
                                <option value="" selected hidden disabled>select</option>
                                @php
                                    $countries = countries()
                                @endphp
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col">
                            <label class="fw-bold" for="state-dd">state</label>
                            <select name="state" class="form-control shadow-none @error('state')  is-invalid @enderror" id="state-dd"></select>
                            @error('state')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col">
                            <label class="fw-bold" for="city-dd">city</label>
                            <select name="city" class="form-control shadow-none @error('city')  is-invalid @enderror" id="city-dd"></select>
                            @error('city')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-4">
                            <label class="fw-bold" for="website">Website</label>
                            <input type="url" class="form-control shadow-none">
                            @error('website')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-4">
                            <label class="fw-bold" for="role">Role <span class="text-danger small"><sup>*</sup></span></label>
                            <select name="role" class="form-control shadow-none @error('role')  is-invalid @enderror" id="role">
                                <option value="" selected hidden disabled>select role</option>
                                @if ($type== 'admin')
                                    <option value="admin" selected>admin</option>
                                    {{-- <option value="seller">seller</option>
                                    <option value="user">Customer</option> --}}
                                @elseif ($type== 'seller')
                                    {{-- <option value="admin">admin</option> --}}
                                    <option value="seller" selected >seller</option>
                                    {{-- <option value="user">Customer</option> --}}
                                @elseif ($type== 'customer')
                                    {{-- <option value="admin">admin</option>
                                    <option value="seller">seller</option> --}}
                                    <option value="user" selected>Customer</option>
                                @endif
                            </select>
                            @error('role')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @if ($type !== 'customer')
                    <div class="mb-3">
                        <h6 class="fw-bold">Module Permissions</h6>
                        <div class="row">
                            <div class="col">
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" name="dashboard" value="1" id="dashboard">
                                    <label class="form-check-label fw-bold" for="dashboard">Dashboard</label>
                                </div>
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" name="manage_users" value="1" id="user">
                                    <label class="form-check-label fw-bold" for="user">User</label>
                                </div>
                                <div class="ms-3 d-none" id="user_category">
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" name="customers" value="1" id="customer">
                                        <label class="form-check-label fw-bold" for="customer">Customer</label>
                                    </div>
                                    @if ($type== 'admin')
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" name="sellers" value="1" id="seller">
                                        <label class="form-check-label fw-bold" for="seller">Sellers</label>
                                    </div>
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" name="admin" value="1" id="admin">
                                        <label class="form-check-label fw-bold" for="admin">Admin</label>
                                    </div>
                                    @endif
                                </div>
                                {{-- <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" name="menu_management" value="1" id="menu_management">
                                    <label class="form-check-label fw-bold" for="menu_management">Menu Management</label>
                                </div> --}}
                                @if ($type== 'admin')
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" value="1" name="locations" id="locations">
                                    <label class="form-check-label fw-bold" for="locations">Locations</label>
                                </div>
                                @endif
                            </div>
                            <div class="col">
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" value="1" name="product_manage" id="product_management">
                                    <label class="form-check-label fw-bold" for="product_management">Product Management</label>
                                </div>
                                <div class="ms-4 d-none" id="product_management_list">
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" name="brand" value="1" id="brand">
                                        <label class="form-check-label fw-bold" for="brand">Brands</label>
                                    </div>
                                    @if ($type == 'admin')
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" name="categories_manage" value="1" id="category">
                                        <label class="form-check-label fw-bold" for="category">Category</label>
                                    </div>
                                    <div class="ms-4 d-none" id="category_list">
                                        <div class="form-check my-2">
                                            <input class="form-check-input" type="checkbox" name="category" value="1" id="categories">
                                            <label class="form-check-label fw-bold" for="categories">Categories</label>
                                        </div>
                                        <div class="form-check my-2">
                                            <input class="form-check-input" type="checkbox" name="sub_category" value="1" id="subcategories">
                                            <label class="form-check-label fw-bold" for="subcategories">SubCategories</label>
                                        </div>
                                        <div class="form-check my-2">
                                            <input class="form-check-input" type="checkbox" value="1" name="child_category	" id="childcategories">
                                            <label class="form-check-label fw-bold" for="childcategories">ChildCategories</label>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" value="1" name="products" id="product">
                                        <label class="form-check-label fw-bold" for="product">Product</label>
                                    </div>
                                    @if ($type == 'admin')
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" value="1" name="coupons" id="coupons">
                                        <label class="form-check-label fw-bold" for="coupons">Coupons</label>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" name="create_store" value="1" id="store">
                                    <label class="form-check-label fw-bold" for="store">Stores</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" value="1" name="ratings" id="review_rating">
                                    <label class="form-check-label fw-bold" for="review_rating">Review & Ratings</label>
                                </div>
                                {{-- <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" value="" id="mt">
                                    <label class="form-check-label fw-bold" for="mt">Marketing Tools</label>
                                </div> --}}
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" value="1" name="orders" id="orders">
                                    <label class="form-check-label fw-bold" for="orders">Order & Invoice</label>
                                </div>
                                <div class="ms-4 d-none" id="order_list">
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" value="2" name="all_orders" id="all_orders">
                                        <label class="form-check-label fw-bold" for="all_orders">All Orders</label>
                                    </div>
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" value="1" name="pending_orders" id="pending_orders">
                                        <label class="form-check-label fw-bold" for="pending_orders">Pending Orders</label>
                                    </div>
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" value="1" name="cancel_order" id="canceled_order">
                                        <label class="form-check-label fw-bold" for="canceled_order">Canceled Orders</label>
                                    </div>
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" value="1" name="returned_order" id="returned_ordered">
                                        <label class="form-check-label fw-bold" for="returned_ordered">Returned Order</label>
                                    </div>
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" value="1" name="invoce" id="invoice">
                                        <label class="form-check-label fw-bold" for="invoice">Invoice</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="mb-3">
                        <button class="btn btn-dark btn-sm float-end me-3"><i class="bx bx-plus"></i> Add user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @section('js')
    <script>
        $('#user').click(function(){
            if($('#user').is(":checked"))
                $('#user_category').removeClass('d-none');
            else
                $('#user_category').addClass('d-none');
        });
        $('#product_management').click(function(){
            if($('#product_management').is(":checked"))
                $('#product_management_list').removeClass('d-none');
            else
                $('#product_management_list').addClass('d-none');
        });
        $('#category').click(function(){
            if($('#category').is(":checked"))
                $('#category_list').removeClass('d-none');
            else
                $('#category_list').addClass('d-none');
        });
        $('#orders').click(function(){
            if($('#orders').is(":checked"))
                $('#order_list').removeClass('d-none');
            else
                $('#order_list').addClass('d-none');
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#country-dd').on('change', function () {
                var idCountry = this.value;
                $("#state-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dd').html('<option value="">Select State</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#state-dd').on('change', function () {
                var idState = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endsection
@endsection
