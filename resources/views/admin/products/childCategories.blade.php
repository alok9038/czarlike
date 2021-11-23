@extends('layouts.adminBase')
@section('title','Categories | Admin')
@section('product_management','mm-active')
@section('child_category','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">ChildCategory</h4>
                <span class="ms-auto"><a href="
                    {{ route('super.admin.child.category.view.create') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add New</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-striped table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Parent Category</th>
                                <th>Parent Subcategory</th>
                                <th>Status</th>
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($childcategories as $ccat)
                            <tr>
                                <td>{{ $ccat->id }}</td>
                                <td>{{ $ccat->title }}</td>
                                <td>
                                    @if ($ccat->image !== null)
                                        <img src="{{ asset('images/category/'.$ccat->image) }}" alt="" class="img-fluid rounded-10 shadow" style="height: 50px; width:50px; object-fit:cover" >
                                    @else
                                        --- no logo ---
                                    @endif
                                </td>
                                <td>{{ $ccat->cat->title }}</td>
                                <td>{{ $ccat->subcat->title }}</td>
                                <td>
                                    @if ($ccat->status == 1)
                                        <form action="{{ route('super.admin.child.category.change.status') }}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="text" value="{{ $ccat->status }}" name="status" hidden>
                                            <input type="text" value="{{ $ccat->id }}" name="child_category_id" hidden>
                                            <button class="btn btn-success btn-sm">Active</button>
                                        </form>
                                    @else
                                        <form action="{{ route('super.admin.child.category.change.status') }}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="text" value="{{ $ccat->status }}" name="status" hidden>
                                            <input type="text" value="{{ $ccat->id }}" name="child_category_id" hidden>
                                            <button class="btn btn-danger btn-sm">Deactive</button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('super.admin.childcategory.delete') }}" method="POST">
                                            @csrf
                                            <input type="text" name="category_id" value="{{ $ccat->id }}" hidden>
                                            <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                        <a href="#childcategoryedit{{ $ccat->id }}" data-bs-toggle="modal" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a>
                                    </div>
                                </td>
                            </tr>


                            <!-- Modal -->
                            <div class="modal fade" id="childcategoryedit{{ $ccat->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update ChildCategory</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('super.admin.child.category.update') }}" enctype="multipart/form-data" method="POST">
                                            @csrf
                                            <input type="hidden" name="child_cat_id" value="{{ $ccat->id }}">
                                            <div class="mb-3">
                                                <label class="fw-bold" for="parent_cat">Parent Category</label>
                                                <select name="category" id="parent_cat" class="form-select">
                                                    @foreach (all_categories() as $category)
                                                        @if ($ccat->parent_cat == $category->id)
                                                            <option value="{{ $category->id }}"  selected>{{ $category->title }}</option>
                                                        @else
                                                            <option value="{{ $category->id }}" >{{ $category->title }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="fw-bold" for="parent_sub_cat">Parent Sub-Category</label>
                                                <select name="sub_category" id="parent_sub_cat" class="form-select">
                                                    @foreach (allSubcategories() as $scategory)
                                                        @if ($ccat->parent_sub_cat == $scategory->id)
                                                            <option value="{{ $scategory->id }}"  selected>{{ $scategory->title }}</option>
                                                        @else
                                                            <option value="{{ $scategory->id }}" >{{ $scategory->title }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="category" class="fw-bold">ChildCategory Title</label>
                                                <input type="text" name="childcategory" id="category" value="{{ $ccat->title }}" class="form-control shadow-none">
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="fw-bold">Description : </label>
                                                <textarea name="description" id="description" cols="30" rows="2" class="form-control shadow-nonw">{{ $ccat->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <img src="{{ asset('images/category/'.$ccat->image) }}" style="height: 150px;" alt="" class="img-fluid">
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
