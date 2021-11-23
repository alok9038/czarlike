@extends('layouts.adminBase')
@section('title','Add new Category | Admin')
@section('product_management','mm-active')
@section('category-select','mm-active')
@section('subcategory-select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Add SubCategory</h4>
                <span class="ms-auto"><a href="
                    {{ route('super.admin.slider.view') }}
                    " class="btn btn-secondary btn-sm"><i class="bx bx-left-arrow"></i>back</a></span>
            </div>
            <div class="card-body">
                <div class="col-8 mx-auto">
                    <form action="{{ route('super.admin.subcategory.create') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category" class="fw-bold">Parent Category</label>
                            <select name="category" id="category" class="form-control shadow-none">
                                <option value="" selected hidden disabled>select</option>
                                @foreach (categories() as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory" class="fw-bold">SubCategory</label>
                            <input type="text" name="subcategory" id="subcategory" class="form-control shadow-none">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="fw-bold">Description : </label>
                            <textarea name="description" id="description" cols="30" rows="7" class="form-control shadow-nonw"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="fw-bold">Image</label>
                            <input type="file" onchange="readURL(this);" name="image" id="image" class="form-control shadow-none">
                            <p class="small text-muted">(Please Choose Brand Image)</p>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="fw-bold">Status</label>
                            <label class="switch">
                                <input type="checkbox" value="1" name="status">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark btn-sm float-end">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('js')

    @endsection
@endsection
