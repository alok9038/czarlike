@extends('layouts.adminBase')
@section('title','Site Settings | Admin')
@section('content')
<div class="container my-5 mb-3">
    <h5>Settings</h5>
    <div class="card border-0 cws-shadow-md rounded-10">
        <div class="card-header border-0 bg-transparent">
        </div>
        <div class="card-body">
            <h5 class="text-center">Logo </h5>
            <div class="d-flex">
                <img src="{{ asset('images/logo/'.site()->logo) }}" class="img-fluid mx-auto" style="height: 150px; width:200px;" alt="logo">
            </div>
            <div class="mb-3">
                <button data-bs-toggle="modal" data-bs-target="#updateLogo" class="btn border-0 shadow-none d-flex mx-auto text-muted"><i class="fa fa-edit"></i> Change</button>
            </div>
            <form action="{{ route('super.admin.update.site.favicon') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row mb-5">
                    <div class="col-lg-3 mb-3">
                        <img src="{{ asset('images/favicon/'.site()->favicon) }}" alt="favicon" class="img-fluid border blah" style="height: 80px; width:80px;">
                    </div>
                    <div class="mb-3 col-lg-6 ">
                        <label for="">Favicon</label>
                        <div class="input-group">
                            <input type="file" name="favicon" onchange="readURL(this);" class="form-control shadow-none">
                            <button class="btn btn-dark btn-sm">upload</button>
                        </div>
                    </div>
                </div>
            </form>
           <form action="{{ route('super.admin.update.site.details') }}" method="post">
                @csrf
                <div>
                    <div class="mb-3">
                        <label for="contact" class="fw-bold">Contact</label>
                        <input type="number" value="{{ site()->contact }}" name="contact" class="form-control rounded-10 ">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="fw-bold">Email</label>
                        <input type="email" value="{{ site()->email }}" name="email" class="form-control rounded-10 ">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="fw-bold">Address</label>
                        <textarea name="address" class="rounded-10 form-control shadow-none" id="address" cols="30" rows="3">{{ site()->address }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">About us :</label>
                        <textarea name="about_us" class="rounded-10 form-control shadow-none" id="" cols="30" rows="5">{{ site()->about_us }}</textarea>
                    </div>
                    <div class="mb-3">
                        <h5>Social Links :</h5>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="facebook" class="fw-bold">Facebook</label>
                                <input type="text" name="facebook" value="{{ site()->facebook }}" class="form-control rounded-10">
                            </div>
                            <div class="col">
                                <label for="facebook" class="fw-bold">Twitter</label>
                                <input type="text" name="twitter" value="{{ site()->twitter }}" class="form-control rounded-10">
                            </div>
                            <div class="col">
                                <label for="facebook" class="fw-bold">Linkedin</label>
                                <input type="text" name="linkedin" value="{{ site()->linkedin }}" class="form-control rounded-10">
                            </div>
                            <div class="col">
                                <label for="facebook" class="fw-bold">Google</label>
                                <input type="text" name="google" value="{{ site()->google }}" class="form-control rounded-10">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn-dark btn btn-sm float-end">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- update profile image --}}
<div class="modal fade" id="updateLogo" tabindex="-1" aria-labelledby="updateLogo" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-10">
        <div class="modal-header py-2">
          <h5 class="modal-title" id="updateImage">Update Site Logo</h5>
          <button type="button" class="close bg-white border-0" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <img src="{{ asset('images/logo/'.site()->logo) }}" class="img-fluid rounded-10 w-100 blah" id="blah" style="height: 300px; width:300px;object-fit:cover;" alt="">
            <form action="{{ route('super.admin.update.site.logo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="my-3 col-lg-8">
                    <label class="small" for="image">Upload Logo</label>
                    <input type="file" name="logo" onchange="readURL(this);" class="form-control shadow-none">
                </div>
                <div class="mb-3">
                    <button class="btn btn-dark btn-sm float-end" type="submit">Update</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
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
