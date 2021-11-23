@extends('layouts.sellerBase')
@section('title','brands | Admin')
@section('product_management','mm-active')
@section('brand-select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Brand</h4>
                <span class="ms-auto"><a href="
                    {{ route('seller.brand.view.create') }}
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
                                <td ><span class="badge bg-light-danger text-danger">{{ $brand->status }}</span></td>
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
                                        <a href="{{ route('super.admin.brand.view.update','brand_id='.$brand->id) }}" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
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
