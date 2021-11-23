@extends('layouts.adminBase')
@section('title','Add new Brand | Admin')
@section('product_management','mm-active')
@section('brand-select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Brand</h4>
                <span class="ms-auto"><a href="
                    {{ route('super.admin.slider.view') }}
                    " class="btn btn-secondary btn-sm"><i class="bx bx-left-arrow"></i>back</a></span>
            </div>
            <div class="card-body">
                <div class="col-8 mx-auto">
                    <form action="{{ route('super.admin.brand.create') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="brand_name" class="fw-bold">Brand Name</label>
                            <input type="text" name="brand_name" id="brand_name" value="{{ old('brand_name') }}" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label for="brand_logo" class="fw-bold">Brand Logo (optional)</label>
                            <input type="file" onchange="readURL(this);" name="brand_logo" id="brand_logo" class="form-control shadow-none">
                            <p class="small text-muted">(Please Choose Brand Image)</p>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="fw-bold">Choose Category : </label>
                            <select name="category" class="form-control shadow-none" id="category">
                                <option value="" hidden disabled selected>select category</option>
                                @foreach (categories() as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="fw-bold">Status</label>
                            <label class="switch">
                                <input type="checkbox" value="active" name="status">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark btn-sm float-end">Add Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('js')

    @endsection
@endsection
