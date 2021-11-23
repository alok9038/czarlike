@extends('layouts.adminBase')
@section('title','Add new Product | Admin')
@section('product_management','mm-active')
@section('product-select','mm-active')
@section('css')
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<style>
    .ff_fileupload_start_upload{
        display: none!important;
    }
</style>
@endsection

@section('content')
    <div class="container my-4">
        <div class="card border-0 mb-3 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Manage Product</h4>
                {{-- <span class="ms-auto"><a href="{{ route('super.admin.product.view') }}" class="btn btn-secondary btn-sm"><i class="bx bx-left-arrow"></i>back</a></span> --}}
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset('images/products/'.$product->image) }}" class="img-fluid w-100" style="height: 230px;" alt="">
                    </div>
                    <div class="col-9">
                        <h4 class="h5">{{ $product->name }}</h4>
                        <p class="text-muted h6">₹ {{ $product->offer_price }} <span class="ms-3 small"><del>₹ {{ $product->price }}</del></span></p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0">
                <button class="btn bg-light-success text-success d-flex ms-auto" id="add_more_div">Add More Variants</button>
            </div>
        </div>
        <form action="{{ route('super.admin.add.variant') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="container p-0" id="product_attr_box">
                @php
                    $sr=0;
                @endphp
                @foreach ($variants as $variant)
                @php
                    $sr +=1;
                @endphp
                <input type="hidden" name="variant_id[]" value="{{$variant->id}}">
                <div class="card border-0 mb-3 rounded-10 card-shadow" id="product_attr_{{ $sr }}">
                    <div class="card-header border-0 pt-3 bg-transparent d-flex">
                        <h4 class="card-title">Add variant</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="mb-3 col">
                                <label for="sku" class="fw-bold">Sku <span class="text-danger">*</span></label>
                                <input type="text" name="sku[]" required id="sku" value="{{ $variant->sku }}" class="form-control shadow-none @error('sku') is-invalid @enderror">
                                @error('sku')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="mrp" class="fw-bold">MRP</label>
                                <input type="number" name="mrp[]" id="mrp" value="{{ $variant->mrp }}" class="form-control shadow-none @error('mrp') is-invalid @enderror">
                                @error('mrp')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="price" class="fw-bold">Price</label>
                                <input type="number" name="price[]" id="price" value="{{ $variant->price }}" class="form-control shadow-none @error('price') is-invalid @enderror">
                                @error('price')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="qty" class="fw-bold">Qty</label>
                                <input type="number" name="qty[]" id="qty" value="{{ $variant->qty }}" class="form-control shadow-none @error('qty') is-invalid @enderror">
                                @error('qty')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col">
                                <label for="color_id" class="fw-bold">Color</label>
                                <select name="color[]" id="color_id" class="form-select shadow-none @error('color') is-invalid @enderror">
                                    <option value="" selected>no color</option>
                                    @foreach (colors() as $color)
                                        @if ($variant->color == $color->id)
                                            <option value="{{ $color->id }}" selected>{{ $color->color_name }}</option>
                                        @endif
                                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                    @endforeach
                                </select>
                                @error('color')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col">
                                <label for="size_id" class="fw-bold">Size</label>
                                <select name="size[]" id="size_id" class="form-select shadow-none @error('size') is-invalid @enderror">
                                    <option value="" selected>no size</option>
                                    @foreach (sizes() as $size)
                                        @if ($variant->size == $size->id)
                                            <option value="{{ $size->id }}" selected>{{ $size->size }}</option>
                                        @endif
                                        <option value="{{ $size->id }}">{{ $size->size }}</option>
                                    @endforeach
                                </select>
                                @error('size')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <img src="{{ asset('images/products/variants/'.$variant->image) }}" alt="" class="img-fluid">
                            <label for="image">Image</label>
                            <input type="file" name="image[]" class="form-control" id="image">
                        </div> --}}
                    </div>
                    <div class="card-footer border-0 bg-transparent">
                        {{-- @if ($sr !== 1) --}}
                            <button type="button" id="remove_btn_{{ $sr }}" onclick="remove_more({{ $sr }})" value="{{ $variant->id }}" class="btn btn-danger d-flex ms-auto">Remove</button>
                        {{-- @endif --}}
                    </div>
                </div>
                @endforeach
                @if ($variants->count() == 0)
                <input type="hidden" name="variant_id[]">
                <div class="card border-0 mb-3 rounded-10 card-shadow" id="product_attr_{{ $sr }}">
                    <div class="card-header border-0 pt-3 bg-transparent d-flex">
                        <h4 class="card-title">Add new variant</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="mb-3 col">
                                <label for="sku" class="fw-bold">Sku <span class="text-danger">*</span></label>
                                <input type="text" name="sku[]" id="sku" required class="form-control shadow-none @error('sku') is-invalid @enderror">
                                @error('sku')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="mrp" class="fw-bold">MRP</label>
                                <input type="number" name="mrp[]" id="mrp" class="form-control shadow-none @error('mrp') is-invalid @enderror">
                                @error('mrp')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="price" class="fw-bold">Price</label>
                                <input type="number" name="price[]" id="price" class="form-control shadow-none @error('price') is-invalid @enderror">
                                @error('price')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="qty" class="fw-bold">Qty</label>
                                <input type="number" name="qty[]" id="qty" class="form-control shadow-none @error('qty') is-invalid @enderror">
                                @error('qty')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col">
                                <label for="color_id" class="fw-bold">Color</label>
                                <select name="color[]" id="color_id" class="form-select shadow-none @error('color') is-invalid @enderror">
                                    <option value="" selected>no color</option>
                                    @foreach (colors() as $color)
                                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                    @endforeach
                                </select>
                                @error('color')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col">
                                <label for="size_id" class="fw-bold">Size</label>
                                <select name="size[]" id="size_id" class="form-select shadow-none @error('size') is-invalid @enderror">
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
                        {{-- <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="image[]" class="form-control" id="image">
                        </div> --}}
                    </div>
                    <div class="card-footer border-0 bg-transparent">
                        {{-- @if ($sr !== 1) --}}
                            {{-- <button type="button" onclick="remove_more({{ $sr }})" value="{{ $sr }}" class="btn btn-danger d-flex ms-auto">Remove</button> --}}
                        {{-- @endif --}}
                    </div>
                </div>
                @endif
            </div>

            <div class="mb-3">
                <input type="submit" value="submit" id="submit_btn" class="btn btn-dark d-flex ms-auto">
            </div>
        </form>
        {{-- <button class="btn btn-dark d-flex ms-auto" id="add_more_div">Add more</button> --}}
    </div>
    @section('js')
    {{-- <script
  src="https://code.jquery.com/jquery-2.2.3.min.js"
  integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="
  crossorigin="anonymous"></script> --}}
    <script>
        var loop_count={{ $variants->count()+1 }} ;
        $("#add_more_div").click(function () {
            loop_count++;

            var html = '<input type="hidden" name="variant_id[]"><div class="card border-0 mb-3 rounded-10 card-shadow" id="product_attr_'+loop_count+'"><div class="card-header border-0 pt-3 bg-transparent d-flex"><h4 class="card-title">Add new variant</h4></div><div class="card-body"> ';

            html += '<div class="row mb-3"><div class="col"><label for="mrp" class="fw-bold">MRP</label><input type="number" name="mrp[]" id="mrp" class="form-control shadow-none"></div><div class="col"><label for="price" class="fw-bold">Price</label><input type="number" name="price[]" id="price" class="form-control shadow-none"></div><div class="col"><label for="qty" class="fw-bold">Qty</label><input type="number" name="qty[]" id="qty" class="form-control shadow-none"></div></div>';

            var size_id_html=jQuery('#size_id').html();
            var color_id_html=jQuery('#color_id').html();
            html += '<div class="row"><div class="mb-3 col"><label for="sku" class="fw-bold">Sku</label><input required type="text" name="sku[]" id="sku" class="form-control shadow-none"></div><div class="mb-3 col"><label for="color_id" class="fw-bold">Color</label><select id="color_id" name="color[]" class="form-select shadow-none">'+color_id_html+'</select></div><div class="mb-3 col"><label for="size_id" class="fw-bold">Size</label><select id="size_id" name="size[]" class="form-select shadow-none">'+size_id_html+'</select></div></div>';

            // html += '<div class="mb-3"><label for="image">Image</label><input type="file" name="image[]" class="form-control" id="image"></div>'

            html += '</div><div class="card-footer border-0 bg-transparent"><button type="button" onclick=remove_more("'+loop_count+'") value="'+loop_count+'" class="btn btn-danger d-flex ms-auto">Remove</button></div></div>'

            $("#product_attr_box").append(html);
        });

        // $("#remove_div").click(function () {
        //     var id = $(this).val()
        //     alert('hello');
        //     jQuery('#product_attr_'+id).remove();
        // });
        // var = btnval[];
        function remove_more(loop_count){
            // alert(loop_count);

            var btnval = jQuery('#remove_btn_'+loop_count).val();
            jQuery('#submit_btn').after(
                "<input name='delete_variant[]' type='hidden' value="+btnval+">"
            );

            jQuery('#product_attr_'+loop_count).remove();
        }
    </script>
    @endsection
@endsection
