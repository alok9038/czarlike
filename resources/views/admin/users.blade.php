@extends('layouts.adminBase')
@section('title','All users | Admin')
@section('user_select','mm-active')
@if ($type == 1)
    @section('customer_select','mm-active')
@elseif ($type ==  3)
    @section('admin_select','mm-active')
@elseif ($type ==  2)
    @section('seller_select','mm-active')
@endif
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                @if ($type == 1)
                <h4 class="card-title">All Customer</h4>
                @elseif ($type == 3)
                <h4 class="card-title">All Admin</h4>
                @elseif ($type == 2)
                <h4 class="card-title">All Seller</h4>
                @endif
                {{-- <div class="search ms-auto">
                    <input type="search" placeholder=" search users" class="form-control rounded-10">
                </div> --}}
                <span class="ms-auto"><a href="
                    @if ($type == 1)
                    {{ route('super.admin.create.user','type=customer') }}
                    @elseif ($type == 2)
                    {{ route('super.admin.create.user','type=seller') }}
                    @elseif ($type == 3)
                    {{ route('super.admin.create.user','type=admin') }}
                    @endif
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add new</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-striped table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Image</th>
                                <th>User Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Member Since</th>
                                <th>Status</th>
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><img src="{{ asset('users/images/'.$user->image) }}" class="rounded-10" style="height: 40px; width:40px;" alt=""></td>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <form action="{{ route('super.admin.activate.deactive.user') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        @if ($user->status == 'active')
                                            <button type="submit" class=" btn btn-dark badge btn-sm bg-success">Active</button>
                                        @else
                                            <button type="submit" class=" btn badge btn-sm bg-danger">Deactive</button>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('super.admin.drop.user') }}" method="POST">
                                            @csrf
                                            <input type="text" name="user_id" value="{{ $user->id }}" hidden>
                                            <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                        {{-- <a href="{{ route() }}" data-bs-toggle="modal" data-bs-target="#editUser" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a> --}}
                                        <form action="{{ route('super.admin.update.user.view') }}" method="get">
                                            <input type="text" name="user_id" value="{{ $user->id }}" hidden>
                                            <button class="btn btn-sm btn-info"><i class="bx bx-edit"></i></button>
                                        </form>
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
                                <th>status</th>
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
