@extends('layouts.adminBase')
@section('title','Create New Store | Admin')
@section('stores','mm-active')
@section('store_select','mm-active')
@section('css')

<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Add new Store</h4>
                <span class="ms-auto"><a href="#" class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Back</a></span>
            </div>
            <div class="card-body">
                <form action="{{ route('super.admin.create.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label class="fw-bold" for="store_owner">Store Owner <span class="text-danger"><sup>*</sup></span></label>
                            <select class="single-select" name="store_owner" id="store_owner">
                                <option value="" selected hidden disabled></option>
                                @foreach ($owners as $user)
                                    <option value="{{ $user->id }}">{{ $user->user_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label class="fw-bold" for="store_name">Store Name <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" name="store_name" id="store_name" value="{{ old('store_name') }}" class="form-control shadow-none @error('store_name') is-invalid @enderror">
                            @error('store_name')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="fw-bold" for="gst">VAT/GSTIN No:</label>
                            <input type="text" name="gst" id="gst" value="{{ old('gst') }}" class="form-control shadow-none @error('gst') is-invalid @enderror">
                            {{-- @error('store_owner')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror --}}
                        </div>
                        <div class="col">
                            <label class="fw-bold" for="bussiness_email">Bussness Email <span class="text-danger"><sup>*</sup></span></label>
                            <input type="email" name="bussiness_email" id="bussiness_email" value="{{ old('bussiness_email') }}" class="form-control shadow-none @error('bussiness_email') is-invalid @enderror">
                            @error('bussiness_email')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="fw-bold" for="store_phone">Phone <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" name="store_phone" id="store_phone" value="{{ old('store_phone') }}" class="form-control shadow-none @error('store_phone') is-invalid @enderror">
                            @error('store_phone')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="fw-bold" for="store_add">Store Address <span class="text-danger"><sup>*</sup></span></label>
                            <textarea name="store_add" id="store_add" cols="10" rows="4" class="form-control shadow-none"></textarea>
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
                                <input type="number" name="pincode" id="pincode" class="form-control shadow-none">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold" for="logo">Logo</label>
                        <input type="file" name="store_logo" id="logo" class="form-control shadow-none">
                    </div>
                    <style>
                        /* Basic Rules */
                        .switch input {
                            display:none;
                        }
                        .switch {
                            display:inline-block;
                            width:60px;
                            height:30px;
                            margin:8px;
                            transform:translateY(50%);
                            position:relative;
                        }
                        /* Style Wired */
                        .slider {
                            position:absolute;
                            top:0;
                            bottom:0;
                            left:0;
                            right:0;
                            border-radius:30px;
                            box-shadow:0 0 0 2px #777, 0 0 4px #777;
                            cursor:pointer;
                            border:4px solid transparent;
                            overflow:hidden;
                            transition:.4s;
                        }
                        .slider:before {
                            position:absolute;
                            content:"";
                            width:100%;
                            height:100%;
                            background:#777;
                            border-radius:30px;
                            transform:translateX(-30px);
                            transition:.4s;
                        }

                        input:checked + .slider:before {
                            transform:translateX(30px);
                            background:limeGreen;
                        }
                        input:checked + .slider {
                            box-shadow:0 0 0 2px limeGreen,0 0 2px limeGreen;
                        }

                        /* Style Flat */
                        .switch.flat .slider {
                        box-shadow:none;
                        }
                        .switch.flat .slider:before {
                        background:#FFF;
                        }
                        .switch.flat input:checked + .slider:before {
                        background:white;
                        }
                        .switch.flat input:checked + .slider {
                        background:limeGreen;
                        }
                    </style>
                    <div class="mb-3 row">
                        <div class="col-4">
                            <label class="fw-bold" for="logo">Status</label>
                            <label class="switch">
                                <input type="checkbox" value="1" name="status">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="col-4">
                            <label class="fw-bold" for="logo">Verified Store</label>
                            <label class="switch">
                                <input type="checkbox" value="1" name="verified">
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
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
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
