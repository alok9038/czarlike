@extends('layouts.adminBase')
@section('title','All sellers | Admin')
@section('user_select','mm-active')
@section('seller_select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">All Sellers</h4>
                {{-- <div class="search ms-auto">
                    <input type="search" placeholder=" search sellers" class="form-control rounded-10">
                </div> --}}
                <span class="ms-auto"><a href="#" class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add new</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example" class="table table-striped table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Image</th>
                                <th>User Name</th>
                                <th>Phone</th>
                                <th>Member Since</th>
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $seller)
                            <tr>
                                <td>{{ $seller->id }}</td>
                                <td><img src="{{ asset('users/images/'.$seller->image) }}" class="rounded-10" style="height: 40px; width:40px;" alt=""></td>
                                <td>{{ $seller->user_name }}</td>
                                <td>{{ $seller->phone }}</td>
                                <td>{{ $seller->created_at }}</td>
                                <td>{{ $seller->status }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></a>
                                        <a href="#" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#id</th>
                                <th>Image</th>
                                <th>User Name</th>
                                <th>Phone</th>
                                <th>Member Since</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
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
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
    @endsection
@endsection
