@extends('layouts.adminBase')
@section('title','Edit Product | Admin')
@section('product_management','mm-active')
@section('product-select','mm-active')
@section('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
<style>
    .ff_fileupload_start_upload{
        display: none!important;
    }
</style>
@endsection

@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Edit Product</h4>
                <span class="ms-auto"><a href="#" class="btn btn-secondary btn-sm"><i class="bx bx-left-arrow"></i>back</a></span>
            </div>
            <div class="card-body">
                <div class="col-12 mx-auto">
                    <form action="
                    {{ route('super.admin.product.edit') }}

                    " enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="product_name" class="fw-bold">Product Name <span class="text-danger"><sup>*</sup></span></label>
                                <input type="text" name="product_name" value="{{ $product->name }}" id="product_name" class="@error('product_name') is-invalid @enderror form-control shadow-none">
                                @error('product_name')
                                    <p class="text-small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col">
                                <label for="brand" class="fw-bold">Select Brand</label>
                                {{-- <input type="text" name="brand" id="brand" class="@error('brand') is-invalid @enderror form-control shadow-none"> --}}
                                <select class="single-select" name="brand" id="brand">
                                    <option value="" selected hidden disabled></option>
                                    @foreach (brands() as $brand)
                                        @if ($brand->id == $product->brand_id)
                                            <option value="{{ $brand->id }}" selected>{{ $brand->brand_name }}</option>
                                        @else
                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="category-dd" class="fw-bold">Category <span class="text-danger">*</span></label>
                                <select name="category" id="category-dd" class="form-control shadow-none @error('category') is-invalid @enderror">
                                    <option value="" selected hidden disabled>Select</option>
                                    @foreach (categories() as $cat)
                                        @if ($cat->id == $product->category_id)
                                            <option value="{{ $cat->id }}" selected>{{ $cat->title }}</option>
                                        @else
                                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('category')
                                    <p class="text-small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="subcat-dd" class="fw-bold">SubCategory <span class="text-danger">*</span></label>
                                <select name="subcategory" id="subcat-dd" class="form-control shadow-none @error('subcategory') is-invalid @enderror">
                                    {{-- <option value="" selected hidden disabled>Select</option> --}}
                                </select>
                                @error('subcategory')
                                    <p class="text-small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="child_cat-dd" class="fw-bold">ChildCategory</label>
                                <select name="childcategory" id="child_cat-dd" class="form-control shadow-none @error('childcategory') is-invalid @enderror">
                                    {{-- <option value="" selected hidden disabled>Select</option> --}}
                                </select>
                                @error('childcategory')
                                    <p class="text-small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="store" class="fw-bold">Select Store</label>
                            <select class="single-select" name="brand" id="store">
                                <option value="" selected hidden disabled></option>
                                @foreach (stores() as $store)
                                    @if ($store->id == $product->store_id)
                                        <option value="{{ $store->id }}" selected>{{ $store->store_name }}</option>
                                    @else
                                        <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <p class="small text-muted">(Please Choose Store Name)</p>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="store" class="fw-bold">Image</label>
                                <input id="" type="file" name="image" >
                                <p class="small text-muted">(Please Choose Product Image)</p>
                                @error('image')
                                    <p class="text-small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col">
                                <label for="mi" class="fw-bold">Multiple Images</label>
                                <input id="mi" type="file" name="multiple_images[]" multiple>
                                <p class="small text-muted">(Please Choose Product Image)</p>
                                {{-- @error('image')
                                    <p class="text-small text-danger">{{ $message }}</p>
                                @enderror --}}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="features" class="fw-bold">Key Features</label>
                            <textarea name="features" id="features" cols="30" rows="7" class="form-control shadow-none tinymce-editor">{{ $product->key_features }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="fw-bold">Description</label>
                            <textarea name="description" id="description" cols="30" rows="7" class="form-control shadow-none tinymce-editor">{{ $product->description }}</textarea>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col">
                                <label for="type" class="fw-bold">Type</label>
                                <select name="type" id="type" class="form-control shadow-none">
                                    <option value="" disabled selected hidden>select warranty type</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="duration" class="fw-bold">Warranty (Duration)</label>
                                <input type="number" class="form-control shadow-none" name="duration" id="duration">
                            </div>
                            <div class="col">
                                <label for="duration_type" class="fw-bold">Days/Month/Year</label>
                                <select name="duration_type" id="duration_type" class="form-control shadow-none">
                                    <option value="" disabled selected hidden>select warranty type</option>
                                    <option value="days">Days</option>
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="model" class="fw-bold">Model</label>
                                <input type="text" name="model" id="model" class="form-control shadow-none">
                            </div>
                            <div class="col">
                                <label for="tags" class="fw-bold">Tags</label>
                                <input type="text" placeholder=" Please enter tag seprated by Comma (,)" name="tags" id="tags" class="form-control shadow-none">
                            </div>
                            <div class="col">
                                <label for="sku" class="fw-bold">Sku</label>
                                <input type="text" placeholder=" Please enter Sku" name="sku" id="sku" class="form-control shadow-none">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="price" class="fw-bold">Price <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="price" id="price" value="{{ $product->price }}" class="form-control shadow-none">
                                </div>
                                <div class="col">
                                    <label for="offer_price" class="fw-bold">Offer Price <span class="text-danger"><sup>*</sup></label>
                                    <input type="text" name="offer_price" value="{{ $product->offer_price }}" id="offer_price" class="form-control shadow-none">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="status" class="fw-bold">Free shiping</label>
                                <label class="switch">
                                    <input type="checkbox" value="1" {{ ($product->free_shipping == 1)?"checked":"unchecked" }} name="free_shipping">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="col">
                                <label for="status" class="fw-bold">Deals of the Day</label>
                                <label class="switch">
                                    <input type="checkbox" value="1" {{ ($product->deals_of_the_day == 1)?"checked":"unchecked" }} name="deals_of_the_day">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="col">
                                <label for="status" class="fw-bold">Cash On Delivery</label>
                                <label class="switch">
                                    <input type="checkbox" {{ ($product->codcheck == 1)?"checked":"unchecked" }} value="1" name="codcheck">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            @if (Auth::user()->user_type == 'superAdmin')
                            <div class="col">
                                <label for="status" class="fw-bold">Status</label>
                                <label class="switch">
                                    <input type="checkbox" value="1" {{ ($product->status == 1)?"checked":"unchecked" }} name="status">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="col">
                                <label for="status" class="fw-bold">Featured</label>
                                <label class="switch">
                                    <input type="checkbox" value="1" {{ ($product->featured == 1)?"checked":"unchecked" }} name="featured">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            @endif
                            <div class="col">
                                <label for="status" class="fw-bold">Cancel Available</label>
                                <label class="switch">
                                    <input type="checkbox" value="1" {{ ($product->cancel_avl == 1)?"checked":"unchecked" }} name="cancel_avl">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="return" class="fw-bold">Return Available</label>
                            <select name="return_avl" id="return" class="form-control shadow-none">
                                <option value="" selected hidden disabled>Please choose an option</option>
                                @if ($product->return_avbl == 'yes')
                                    <option value="yes" selected>Return available</option>
                                    <option value="no">Return Not available</option>
                                @elseif ($product->return_avbl == 'no')
                                    <option value="yes" >Return available</option>
                                    <option value="no" selected>Return Not available</option>
                                @else
                                    <option value="yes" >Return available</option>
                                    <option value="no" >Return Not available</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark btn-sm float-end">Edit Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('js')
    <script>
        $(document).ready(function () {
            $('#category-dd').on('change', function () {
                var cat_id = this.value;
                $("#subcat-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-subcat')}}",
                    type: "POST",
                    data: {
                        cat_id: cat_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#subcat-dd').html('<option value="">select</option>');
                        $.each(result.subcats, function (key, value) {
                            $("#subcat-dd").append('<option value="' + value
                                .id + '">' + value.title + '</option>');
                        });
                        $('#child_cat-dd').html('<option value="">select</option>');
                    }
                });
            });
            $('#subcat-dd').on('change', function () {
                var subcat = this.value;
                $("#child_cat-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-childcat')}}",
                    type: "POST",
                    data: {
                        subcat_id: subcat,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#child_cat-dd').html('<option value="">Select</option>');
                        $.each(res.childcats, function (key, value) {
                            $("#child_cat-dd").append('<option value="' + value
                                .id + '">' + value.title + '</option>');
                        });
                    }
                });
            });

        });
    </script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 300,
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
    @endsection
@endsection
