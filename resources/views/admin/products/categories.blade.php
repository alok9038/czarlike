@extends('layouts.adminBase')
@section('title','Categories | Admin')
@section('product_management','mm-active')
@section('category-select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">category</h4>
                <span class="ms-auto"><a href="
                    {{ route('super.admin.category.view.create') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add new category</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-striped table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>category Name</th>
                                <th>category Logo</th>
                                <th>Status</th>
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td><img src="{{ asset('images/category/'.$category->image) }}" alt="" class="img-fluid rounded-10 shadow" style="height: 50px; width:50px; object-fit:cover" ></td>
                                <td>
                                    @if ($category->status == 1)
                                        <form action="{{ route('super.admin.category.change.status') }}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="text" value="{{ $category->status }}" name="status" hidden>
                                            <input type="text" value="{{ $category->id }}" name="category_id" hidden>
                                            <button class="btn btn-success btn-sm">Active</button>
                                        </form>
                                    @else
                                        <form action="{{ route('super.admin.category.change.status') }}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="text" value="{{ $category->status }}" name="status" hidden>
                                            <input type="text" value="{{ $category->id }}" name="category_id" hidden>
                                            <button class="btn btn-danger btn-sm">Deactive</button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('super.admin.category.delete') }}" method="POST">
                                            @csrf
                                            <input type="text" name="cat_id" value="{{ $category->id }}" hidden>
                                            <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                        <a href="#editcat{{ $category->id }}"  data-bs-toggle="modal" data-bs-target="#" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="editcat{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('super.admin.category.update') }}" enctype="multipart/form-data" method="POST">
                                            @csrf
                                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                                            <div class="mb-3">
                                                <label for="category" class="fw-bold">Category</label>
                                                <input type="text" name="category" id="category" value="{{ $category->title }}" class="form-control shadow-none">
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="fw-bold">Description : </label>
                                                <textarea name="description" id="description" cols="30" rows="2" class="form-control shadow-nonw">{{ $category->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <img src="{{ asset('images/category/'.$category->image) }}" style="height: 150px;" alt="" class="img-fluid">
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="fw-bold">Image</label>
                                                <input type="file" onchange="readURL(this);" name="image" id="image" class="form-control shadow-none">
                                                <p class="small text-muted">(Please Choose category Image)</p>
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
		// $(document).ready(function() {
		// 	$('#example').DataTable();
		//   } );
	</script>
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
