@extends('layouts.sellerBase')
@section('title','Add new Brand | Seller')
@section('product_management','mm-active')
@section('product-select','mm-active')
@section('css')
<link href="{{ asset('assets/plugins/fancy-file-uploader/fancy_fileupload.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />

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
                <h4 class="card-title">Add new Product</h4>
                <span class="ms-auto"><a href="#" class="btn btn-secondary btn-sm"><i class="bx bx-left-arrow"></i>back</a></span>
            </div>
            <div class="card-body">
                <div class="col-12 mx-auto">
                    <form action="{{ route('seller.product.create') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="product_name" class="fw-bold">Product Name <span class="text-danger"><sup>*</sup></span></label>
                                <input type="text" name="product_name" id="product_name" class="@error('product_name') is-invalid @enderror form-control shadow-none">
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
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
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
                                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
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
                                    <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                @endforeach
                            </select>
                            <p class="small text-muted">(Please Choose Store Name)</p>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="store" class="fw-bold">Image</label>
                                <input id="" type="file" name="image" accept=".jpg, .png, image/jpeg, image/png">
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
                            <textarea name="features" id="features" cols="30" rows="7" class="form-control shadow-none tinymce-editor"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="fw-bold">Description</label>
                            <textarea name="description" id="description" cols="30" rows="7" class="form-control shadow-none tinymce-editor"></textarea>
                        </div>
                        {{-- <div class="row">
                            <div class="mb-3 col">
                                <label for="video" class="fw-bold">Product Video Preview</label>
                                <input type="url" name="video" id="video" class="form-control shadow-none">
                            </div>
                            <div class="mb-3 col">
                                <label for="video_thumb" class="fw-bold">Product Video Thumbnail</label>
                                <input type="file" name="video_thumb" id="video_thumb" class="form-control shadow-none">
                            </div>
                        </div> --}}
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
                                    <input type="text" name="price" id="price" class="form-control shadow-none">
                                    @error('price')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="offer_price" class="fw-bold">Offer Price <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="offer_price" id="offer_price" class="form-control shadow-none">
                                    @error('offer_price')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="status" class="fw-bold">Free shiping</label>
                                <label class="switch">
                                    <input type="checkbox" value="1" name="free_shipping">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="col">
                                <label for="status" class="fw-bold">Cash On Delivery</label>
                                <label class="switch">
                                    <input type="checkbox" value="1" name="codcheck">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            @if (Auth::user()->user_type == 'superAdmin')
                            <div class="col">
                                <label for="status" class="fw-bold">Status</label>
                                <label class="switch">
                                    <input type="checkbox" value="1" name="status">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="col">
                                <label for="status" class="fw-bold">Featured</label>
                                <label class="switch">
                                    <input type="checkbox" value="1" name="featured">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            @endif
                            <div class="col">
                                <label for="status" class="fw-bold">Cancel Available</label>
                                <label class="switch">
                                    <input type="checkbox" value="1" name="cancel_avl">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="return" class="fw-bold">Return Available</label>
                            <select name="return_avl" id="return" class="form-control shadow-none">
                                <option value="" selected hidden disabled>Please choose an option</option>
                                <option value="yes">Return available</option>
                                <option value="yes">Return Not available</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark btn-sm float-end">Add Product</button>
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

    <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>
    <script>
    $('#fancy-file-upload').FancyFileUpload({
        params: {
            action: 'fileuploader'
        },
        maxfilesize: 1000000
    });
    </script>
    <script>
    $(document).ready(function () {
        $('#image-uploadify').imageuploadify();
    })
    </script>

    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
    @endsection
@endsection
