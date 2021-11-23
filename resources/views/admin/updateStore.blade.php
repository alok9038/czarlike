@extends('layouts.adminBase')
@section('title','Update Store | Admin')
{{-- @section('stores','mm-active') --}}
@section('store_select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Update Store</h4>
                <span class="ms-auto"><a href="#" class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Back</a></span>
            </div>
            <div class="card-body">
                <form action="{{ route('super.admin.create.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label class="fw-bold" for="store_owner">Store Owner <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" name="store_owner" id="store_owner" value="{{ $store->store_owner }}" class="form-control shadow-none @error('store_owner') is-invalid @enderror">
                            @error('store_owner')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="fw-bold" for="store_name">Store Name <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" name="store_name" id="store_name" value="{{ $store->store_name }}" class="form-control shadow-none @error('store_name') is-invalid @enderror">
                            @error('store_name')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="fw-bold" for="store_owner">VAT/GSTIN No:</label>
                            <input type="text" name="store_owner" id="store_owner" value="{{ $store->gst }}" class="form-control shadow-none @error('store_owner') is-invalid @enderror">
                            {{-- @error('store_owner')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror --}}
                        </div>
                        <div class="col">
                            <label class="fw-bold" for="bussiness_email">Bussness Email <span class="text-danger"><sup>*</sup></span></label>
                            <input type="email" name="bussiness_email" id="bussiness_email" value="{{ $store->bussiness_email }}" class="form-control shadow-none @error('bussiness_email') is-invalid @enderror">
                            @error('bussiness_email')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="fw-bold" for="store_phone">Phone <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" name="store_phone" id="store_phone" value="{{ $store->phone }}" class="form-control shadow-none @error('store_phone') is-invalid @enderror">
                            @error('store_phone')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="fw-bold" for="store_add">Store Address <span class="text-danger"><sup>*</sup></span></label>
                            <textarea name="store_add" id="store_add" cols="10" rows="4" class="form-control shadow-none">{{ $store->store_address }}</textarea>
                            @error('store_add')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-bold" for="country-dd">Country <span class="text-danger"><sup>*</sup></span></label>
                                <select name="country" class="form-control" id="country-dd">
                                    <option value="" selected hidden disabled>Select Country</option>
                                    @php
                                        $countries = countries()
                                    @endphp
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold" for="city-dd">City <span class="text-danger"><sup>*</sup></span></label>
                                <select name="city" class="form-control" id="city-dd">
                                    <option value="" selected hidden disabled>Select City</option>
                                </select>
                                @error('city')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-bold" for="state-dd">State <span class="text-danger"><sup>*</sup></span></label>
                                <select name="state" class="form-control" id="state-dd">
                                    <option value="" selected hidden disabled>Select State</option>
                                </select>
                                @error('state')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold" for="pincode">Pincode /Zipcode<span class="text-danger"><sup>*</sup></span></label>
                                <input type="number" name="pincode" id="pincode" value="{{ $store->pincode }}" class="form-control shadow-none">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold" for="logo">Logo</label>
                        <input type="file" name="store_logo" id="logo" class="form-control shadow-none">
                    </div>
                    <style>

                    </style>
                    <div class="mb-3 row">
                        <div class="col-4">
                            <label class="fw-bold" for="logo">Status</label>
                            <label class="switch">
                                <input type="checkbox" name="status">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="col-4">
                            <label class="fw-bold" for="logo">Verified Store</label>
                            <label class="switch">
                                <input type="checkbox" name="is_verified">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-dark btn-sm float-end" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('js')
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
