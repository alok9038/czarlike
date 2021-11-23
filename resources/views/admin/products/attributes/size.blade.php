@extends('layouts.adminBase')
@section('title','Add new Brand | Admin')
@section('product_management','mm-active')
@section('size','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">sizes</h4>
                <span class="ms-auto"><a href="#addColor" data-bs-toggle="modal" class="btn btn-secondary btn-sm"><i class="bx bx-plus"></i>Add new Size</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-hover table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Size</th>
                                {{-- <th>Color</th> --}}
                                <th>Status</th>
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sr = 0;
                            @endphp
                            @foreach ($sizes as $size)
                            <tr>
                                <td>{{ $sr += 1 }}</td>
                                <td>{{ $size->size }}</td>
                                {{-- <td><div class="rounded-10" style="height: 40px; width:40px;background-color:{{ $size->color }}" alt="$size->brand_logo"></div></td> --}}
                                <td>
                                    <form action="{{ route('super.admin.product.size.active.deactive') }}" method="post">
                                        @csrf
                                        <input type="text" name="size_id" value="{{ $size->id }}" hidden>

                                        @if ($size->status == 1)
                                            <button class="border-0 bg-transparent"><div class="p-2 rounded d-inline-flex bg-light-success text-success">active</div></button>
                                        @else
                                            <button class="border-0 bg-transparent"><div class="p-2 rounded d-inline-flex bg-light-danger text-danger">deactive</div></button>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('super.admin.product.delete.size') }}" method="POST">
                                            @csrf
                                            <input type="text" name="size_id" value="{{ $size->id }}" hidden>
                                            <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                        <a href="#editBrand{{ $size->id }}" data-bs-toggle="modal" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="editBrand{{ $size->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Size</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('super.admin.product.update.size') }}" method="POST">
                                            @csrf
                                            <input type="text" name="size_id" value="{{ $size->id }}" hidden>

                                            <div class="mb-3">
                                                <label for="size" class="fw-bold">Size</label>
                                                <input type="text" value="{{ $size->size }}" name="size" id="size" class="form-control shadow-none">
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="fw-bold">Status</label>
                                                <label class="switch">
                                                    <input type="checkbox" {{ ($size->status == 1)?"checked":"" }} value="1" name="status">
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
            <h5 class="modal-title" id="exampleModalLabel">Add Size</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('super.admin.product.add.size') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="size" class="fw-bold">Size</label>
                        <input type="text" value="{{ old('size') }}" name="size" id="size" class="form-control shadow-none">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="color" class="fw-bold">Color</label>
                        <input type="color" name="color" id="color" class="form-control shadow-none">
                        <p class="small text-muted">(Please Choose color)</p>
                    </div> --}}
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
