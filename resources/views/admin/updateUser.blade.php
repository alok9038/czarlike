@extends('layouts.adminBase')
@section('title','Update User | Admin')
@section('user_select','mm-active')
@section('content')
    <div class="container my-3">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Update User</h4>
                <span class="ms-auto"><a href="#" class="btn btn-secondary btn-sm"><i class="bx bx-left-arrow"></i>Back</a></span>
            </div>
            <div class="card-body">
                <form action="{{ route('super.admin.user.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="row">
                        <div class="mb-3 col">
                            <label class="fw-bold" for="user_name">User Name <span class="text-danger small"><sup>*</sup></span></label>
                            <input type="text" id="user_name" name="user_name" value="{{ $user->user_name }}" placeholder="  please enter user name" class="form-control shadow-none @error('name') is-invalid @enderror">
                            @error('user_name')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col">
                            <label class="fw-bold" for="email">Email <span class="text-danger small"><sup>*</sup></span></label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" placeholder="  please enter user email" class="form-control shadow-none @error('email') is-invalid @enderror">
                            @error('email')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="mb-3 col">
                            <label class="fw-bold" for="password">Password<span class="text-danger small"><sup>*</sup></span></label>
                            <input type="password" id="password" name="password" value="{{  }}" placeholder="  please enter user password" class="form-control shadow-none @error('password') is-invalid @enderror">
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
                    </div> --}}
                    <div class="row">
                        <div class="mb-3 col">
                            <label class="fw-bold" for="phone">Phone number</span></label>
                            <input type="tel" id="phone" name="phone" value="{{ $user->phone }}" placeholder="  please enter user phone number" class="form-control shadow-none @error('phone') is-invalid @enderror">
                            @error('phone')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col">
                            <label class="fw-bold" for="role">Role <span class="text-danger small"><sup>*</sup></span></label>
                            <select name="role" class="form-control shadow-none @error('role')  is-invalid @enderror" id="role">
                                <option value="" selected hidden disabled>select role</option>
                                @if ($user->user_type== 'admin')
                                    <option value="admin" selected>admin</option>
                                    <option value="seller">seller</option>
                                    <option value="user">Customer</option>
                                @elseif ($user->user_type== 'seller')
                                    <option value="admin">admin</option>
                                    <option value="seller" selected >seller</option>
                                    <option value="user">Customer</option>
                                @elseif ($user->user_type== 'customer')
                                    <option value="admin">admin</option>
                                    <option value="seller">seller</option>
                                    <option value="user" selected>Customer</option>
                                @endif
                            </select>
                            @error('role')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-4">
                            <label class="fw-bold" for="website">Website</label>
                            <input type="url" placeholder="  https://" value="{{ $user->website }}" class="form-control shadow-none">
                            @error('website')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label class="fw-bold" for="country-dd">Country</label>
                            <select name="country" class="form-control shadow-none @error('country') is-invalid @enderror" id="country-dd">
                                <option value="" selected hidden disabled>select</option>
                                @php
                                    $countries = countries()
                                @endphp
                                @foreach ($countries as $country)
                                    @if ($country->id == $user->country_id)
                                    <option value="{{ $country->id }}" selected >{{ $country->name }}</option>
                                    @endif
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
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
                    <div class="col-5">
                        <div class="mb-3 col">
                            <img src="{{ asset('users/images/'.$user->image) }}" class="img-fluid rounded-10 w-100 blah" id="blah" style="height: 300px; width:300px;object-fit:cover;" alt="">
                            <label class="fw-bold" for="image">Profile Image</label>
                            <input type="file" id="image"  onchange="readURL(this);"  name="image"  class="form-control shadow-none @error('image') is-invalid @enderror">
                            @error('image')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-dark btn-sm float-end"><i class="bx bx-plus"></i> Update user</button>
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
                    $('.blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endsection
@endsection
