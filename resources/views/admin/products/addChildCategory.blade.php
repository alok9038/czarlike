@extends('layouts.adminBase')
@section('title','Add new Category | Admin')
@section('product_management','mm-active')
@section('child_category','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Add ChildCategory</h4>
                <span class="ms-auto"><a href="
                    {{ route('super.admin.slider.view') }}
                    " class="btn btn-secondary btn-sm"><i class="bx bx-left-arrow"></i>back</a></span>
            </div>
            <div class="card-body">
                <div class="col-8 mx-auto">
                    <form action="{{ route('super.admin.child.category.create') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category-dd" class="fw-bold">Parent Category <span class="text-danger"><sup>*</sup></span></label>
                            <select name="category" id="category-dd" class="form-control shadow-none">
                                <option value="" selected hidden disabled>select</option>
                                @foreach (categories() as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subcat-dd" class="fw-bold">Sub Category <span class="text-danger"><sup>*</sup></span></label>
                            <select name="sub_category" id="subcat-dd" class="form-control shadow-none">
                                {{-- <option value="" selected hidden disabled>select</option> --}}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="child_category" class="fw-bold">Child Category <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" name="childcategory" id="child_category" class="form-control shadow-none">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="fw-bold">Description <span class="text-danger"><sup>*</sup></span>: </label>
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
                    }
                });
            });
        });
        </script>
    @endsection
@endsection
