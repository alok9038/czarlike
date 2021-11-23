@extends('layouts.adminBase')
@section('title','brands | Admin')
@section('product_management','mm-active')
@section('brand-select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Brand</h4>
                <span class="ms-auto"><a href="
                    {{ route('super.admin.brand.view.create') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add new Brand</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-striped table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Brand Name</th>
                                <th>Brand Logo</th>
                                <th>Status</th>
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->brand_name }}</td>
                                <td><img src="{{ asset('images/brand/'.$brand->brand_logo) }}" class="rounded-10" style="height: 40px; width:40px;" alt="$brand->brand_logo"></td>
                                <td>
                                    @if ($brand->status == 'active')
                                        <form action="{{ route('super.admin.brand.change.status') }}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="text" value="1" name="status" hidden>
                                            <input type="text" value="{{ $brand->id }}" name="category_id" hidden>
                                            <button class="btn btn-success btn-sm">Active</button>
                                        </form>
                                    @else
                                        <form action="{{ route('super.admin.brand.change.status') }}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="text" value="0" name="status" hidden>
                                            <input type="text" value="{{ $brand->id }}" name="category_id" hidden>
                                            <button class="btn btn-danger btn-sm">Deactive</button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('super.admin.brand.delete') }}" method="POST">
                                            @csrf
                                            <input type="text" name="brand_id" value="{{ $brand->id }}" hidden>
                                            <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                        {{-- <form action="{{ route('super.admin.update.brand.view') }}" method="get">
                                            <input type="text" name="user_id" value="{{ $brand->id }}" hidden>
                                            <button class="btn btn-sm btn-info"><i class="bx bx-edit"></i></button>
                                        </form> --}}
                                        <a href="#editBrand{{ $brand->id }}" data-bs-toggle="modal" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="editBrand{{ $brand->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Brand</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('super.admin.brand.update') }}" enctype="multipart/form-data" method="POST">
                                            @csrf
                                            <input type="hidden" name="brand_id" value="{{ $brand->id }}">
                                            <div class="mb-3">
                                                <label for="brand_name" class="fw-bold">Brand Name</label>
                                                <input type="text" value="{{ $brand->brand_name }}" name="brand_name" id="brand_name" class="form-control shadow-none">
                                            </div>
                                            <div class="mb-3">
                                                <label for="brand_logo" class="fw-bold">Brand Logo (optional)</label>
                                                <input type="file" onchange="readURL(this);" name="brand_logo" id="brand_logo" class="form-control shadow-none">
                                                <p class="small text-muted">(Please Choose Brand Image)</p>
                                            </div>
                                            <div class="mb-3">
                                                <label for="category" class="fw-bold">Choose Category: </label>
                                                <select name="category" class="form-control shadow-none" id="category">
                                                    <option value="" hidden disabled selected>select category</option>
                                                    @foreach (categories() as $cat)
                                                        @if ($cat->id == $brand->category)
                                                        <option value="{{ $cat->id }}" selected>{{ $cat->title }}</option>
                                                        @else
                                                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="fw-bold">Status</label>
                                                <label class="switch">
                                                    <input type="checkbox" {{ ($brand->status == "active")?"checked":"" }} value="1" name="status">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-dark btn-sm float-end">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @section('js')
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				buttons: [ 'colvis','copy', 'excel', 'pdf', 'print'],
                lengthChange: false,
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );

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
@endsection
