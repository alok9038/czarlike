@extends('layouts.adminBase')
@section('title','Countries | Admin')
@section('country','mm-active')
@section('location','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                {{-- @if ($type == 1)
                <h4 class="card-title">All Customer</h4>
                @elseif ($type == 3)
                <h4 class="card-title">All Admin</h4>
                @elseif ($type == 2) --}}
                <h4 class="card-title">All Seller</h4>
                {{-- @endif --}}
                {{-- <div class="search ms-auto">
                    <input type="search" placeholder=" search users" class="form-control rounded-10">
                </div> --}}
                <span class="ms-auto"><a href="
                    {{-- @if ($type == 1)
                    {{ route('super.admin.create.user','type=customer') }}
                    @elseif ($type == 2)
                    {{ route('super.admin.create.user','type=seller') }}
                    @elseif ($type == 3) --}}
                    {{ route('super.admin.create.user','type=admin') }}
                    {{-- @endif --}}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add new</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-striped table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Country Name</th>
                                <th>ISO Code</th>
                                <th>Short Name</th>
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($country as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->phonecode }}</td>
                                <td>{{ $c->shortname }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></a>
                                        <a href="#" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a>
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
	</script>
    @endsection
@endsection
