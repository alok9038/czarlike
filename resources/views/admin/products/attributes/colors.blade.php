@extends('layouts.adminBase')
@section('title','Add new Brand | Admin')
@section('product_management','mm-active')
@section('color','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Colors</h4>
                <span class="ms-auto"><a href="#addColor" data-bs-toggle="modal" class="btn btn-secondary btn-sm"><i class="bx bx-plus"></i>Add new Color</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-hover table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Color Name</th>
                                <th>Color</th>
                                <th>Status</th>
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sr = 0;
                            @endphp
                            @foreach ($colors as $color)
                            <tr>
                                <td>{{ $sr += 1 }}</td>
                                <td>{{ $color->color_name }}</td>
                                <td><div class="rounded-10" style="height: 40px; width:40px;background-color:{{ $color->color }}" alt="$color->brand_logo"></div></td>
                                <td>
                                    <form action="{{ route('super.admin.product.color.active.deactive') }}" method="post">
                                        @csrf
                                        <input type="text" name="color_id" value="{{ $color->id }}" hidden>

                                        @if ($color->status == 1)
                                            <button class="border-0 bg-transparent"><div class="p-2 rounded d-inline-flex bg-light-success text-success">active</div></button>
                                        @else
                                            <button class="border-0 bg-transparent"><div class="p-2 rounded d-inline-flex bg-light-danger text-danger">deactive</div></button>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('super.admin.product.delete.color') }}" method="POST">
                                            @csrf
                                            <input type="text" name="color_id" value="{{ $color->id }}" hidden>
                                            <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                        <a href="#editBrand{{ $color->id }}" data-bs-toggle="modal" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="editBrand{{ $color->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Color</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('super.admin.product.update.color') }}" method="POST">
                                            @csrf
                                            <input type="text" name="color_id" value="{{ $color->id }}" hidden>

                                            <div class="mb-3">
                                                <label for="color_name" class="fw-bold">Color Name</label>
                                                <input type="text" value="{{ $color->color_name }}" name="color_name" id="color_name" class="form-control shadow-none">
                                            </div>
                                            <div class="mb-3">
                                                <label for="color" class="fw-bold">Color</label>
                                                <input type="color" name="color" value="{{ $color->color }}" id="color" class="form-control shadow-none">
                                                <p class="small text-muted">(Please Choose color)</p>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="fw-bold">Status</label>
                                                <label class="switch">
                                                    <input type="checkbox" {{ ($color->status == 1)?"checked":"" }} value="1" name="status">
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

    {{-- add color modal --}}
    <!-- Modal -->
    <div class="modal fade" id="addColor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Color</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('super.admin.product.add.color') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="color_name" class="fw-bold">Color Name</label>
                        <input type="text" value="{{ old('color_name') }}" name="color_name" id="color_name" class="form-control shadow-none">
                    </div>
                    <div class="mb-3">
                        <label for="color" class="fw-bold">Color</label>
                        <input type="color" name="color" id="color" class="form-control shadow-none">
                        <p class="small text-muted">(Please Choose color)</p>
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
