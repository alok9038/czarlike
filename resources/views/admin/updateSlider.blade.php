@extends('layouts.adminBase')
@section('title','Update slider | Admin')
@section('sliders','mm-active')
@section('slider','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Create New Slider</h4>
                {{-- <span class="ms-auto"><a href="
                    {{ route('super.admin.create.slider.view') }}
                    " class="btn btn-secondary btn-sm"><i class="bx bx-plus-circle"></i>back</a></span> --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('super.admin.slider.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="slider_image" class="fw-bold">Slider Image</label>
                                <input type="file" onchange="readURL(this);" name="slider_image" id="slider_image" class="form-control shadow-none">
                            </div>
                            <div class="mb-3">
                                <label for="linked_by" class="fw-bold">Linked By :</label>
                                <select name="linked_by" class="form-control shadow-none" id="linked_by">
                                    <option value="" selected>None</option>
                                    <option value="url">URL</option>
                                    <option value="category">Category</option>
                                    <option value="subCategory">SubCategory</option>
                                    <option value="product">Product</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="url" class="fw-bold">Enter Url : </label>
                                <input type="url" placeholder=" http://" name="url" id="url" class="form-control shadow-none">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="fw-bold">Choose Category : </label>
                                <select name="category" class="form-control shadow-none" id="category">
                                    <option value="" hidden disabled selected>select category</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subcategory " class="fw-bold">Choose SubCategory : </label>
                                <select name="subcategory" class="form-control shadow-none" id="subcategory">
                                    <option value="" hidden disabled selected>select SubCategory</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="product" class="fw-bold">Choose Product : </label>
                                <select name="product" class="form-control shadow-none" id="product">
                                    <option value="" hidden disabled selected>select category</option>
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="heading" class="fw-bold">Slider Top Heading</label>
                                    <input type="text" name="heading" id="heading" class="form-control shadow-none">
                                </div>
                                <div class="col">
                                    <label for="heading_color" class="fw-bold">Text Color</label>
                                    <input type="color" name="heading_color" id="heading_color" class="form-control shadow-none">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="subheading" class="fw-bold">Slider Sub Heading</label>
                                    <input type="text" name="subheading" id="subheading" class="form-control shadow-none">
                                </div>
                                <div class="col">
                                    <label for="sub_heading_color" class="fw-bold">Text Color</label>
                                    <input type="color" name="sub_heading_color" id="sub_heading_color" class="form-control shadow-none">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="button_text" class="fw-bold">Button Text</label>
                                    <input type="text" name="button_text" id="button_text" pattern=" Enter Button text" class="form-control shadow-none">
                                </div>
                                <div class="col-lg-3">
                                    <label for="button_text_color" class="fw-bold">Button Text Color</label>
                                    <input type="color" name="button_text_color" id="button_text_color" class="form-control shadow-none">
                                </div>
                                <div class="col-lg-3">
                                    <label for="button_bg_color" class="fw-bold">Button Bg Color</label>
                                    <input type="color" name="button_bg_color" id="button_bg_color" class="form-control shadow-none">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="fw-bold">Status</label>
                                <label class="switch">
                                    <input type="checkbox" name="is_verified">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-dark btn-sm float-end">Add slider</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <h6>Image Preview :</h6>
                        <div class="card-shadow" style="height: 250px; width:100%;">
                            <img src="" alt="no-image" style="height: 250px; width:100%;" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')

    @endsection
@endsection
