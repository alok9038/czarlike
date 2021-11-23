@extends('layouts.adminBase')
@section('title','Add new Variant | Admin')
@section('product_management','mm-active')
@section('product-select','mm-active')
@section('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<style>
    .ff_fileupload_start_upload{
        display: none!important;
    }
</style>
@endsection
@section('content')
    <div class="container my-4">
        <h5 class="my-3 mb-5">{{ $product->name }}</h5>
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Add new Variant</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('super.admin.store.variant') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="row mb-3">
                        <div class="mb-3 col">
                            <label for="sku" class="fw-bold">Sku <span class="text-danger">*</span></label>
                            <input type="text" name="sku" id="sku" required class="form-control shadow-none @error('sku') is-invalid @enderror">
                            @error('sku')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="mrp" class="fw-bold">MRP</label>
                            <input type="number" name="mrp" id="mrp" class="form-control shadow-none @error('mrp') is-invalid @enderror">
                            @error('mrp')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="price" class="fw-bold">Price</label>
                            <input type="number" name="price" id="price" class="form-control shadow-none @error('price') is-invalid @enderror">
                            @error('price')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="qty" class="fw-bold">Qty</label>
                            <input type="number" name="qty" id="qty" class="form-control shadow-none @error('qty') is-invalid @enderror">
                            @error('qty')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="color_id" class="fw-bold">Color</label>
                            <select name="color" id="color_id" class="form-select shadow-none @error('color') is-invalid @enderror">
                                <option value="" selected>no color</option>
                                @foreach (colors() as $color)
                                    <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach
                            </select>
                            @error('color')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="size_id" class="fw-bold">Size</label>
                            <select name="size" id="size_id" class="form-select shadow-none @error('size') is-invalid @enderror">
                                <option value="" selected >no size</option>
                                @foreach (sizes() as $size)
                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                                @endforeach
                            </select>
                            @error('size')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="ram_rom" class="fw-bold">Ram - Rom</label>
                        <select name="ram_rom" id="ram_rom" class="form-select">
                            <option value="" selected hidden disabled></option>
                            @foreach ($ram_rom as $rr)
                                <option value="{{ $rr->id }}">{{ $rr->ram }} gb / {{ $rr->storage }} gb</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col">
                        <label for="mi" class="fw-bold">Images <span class="text-danger">*</span></label>
                        <input id="mi" type="file" name="multiple_images[]" multiple>
                        <p class="small text-muted">(Please Choose Product Image)</p>
                        {{-- @error('image')
                            <p class="text-small text-danger">{{ $message }}</p>
                        @enderror --}}
                    </div>
                    <div class="mb-3">
                        <label for="features" class="fw-bold">Key Features</label>
                        <textarea name="features" id="features" cols="30" rows="7" class="form-control shadow-none tinymce-editor"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="fw-bold">Description</label>
                        <textarea name="description" id="description" cols="30" rows="7" class="form-control shadow-none tinymce-editor"></textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-dark d-flex ms-auto" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('js')
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

    @endsection
@endsection
