@extends('layouts.adminBase')
@section('title','Add Driver | Admin')
@section('driver_select','mm-active')
@section('content')
    <div class="container my-3">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Add Driver</h4>
                <span class="ms-auto"><a href="#" class="btn btn-secondary btn-sm"><i class="bx bx-left-arrow"></i>Back</a></span>
            </div>
            <div class="card-body">
                <form action="{{ route('super.admin.add.driver') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col">
                            <label class="fw-bold" for="name">Driver Name <span class="text-danger small"><sup>*</sup></span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="  please enter user name" class="form-control shadow-none @error('name') is-invalid @enderror">
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
                        <div class="mb-3 col">
                            <label class="fw-bold" for="id_proof">Aadhar/ Pancard/ Driving Licence / others</label>
                            <input type="file" id="id_proof" name="id_proof"  class="form-control shadow-none @error('id_proof') is-invalid @enderror">
                            @error('id_proof')
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
                    <div class="mb-3">
                        <label for="description" class="fw-bold">Address</label>
                        <textarea name="address" id="description" cols="30" rows="5" class="form-control shadow-none tinymce-editors"></textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-dark btn-sm float-end me-3"><i class="bx bx-plus"></i> Add Driver</button>
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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 200,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>

    @endsection
@endsection
