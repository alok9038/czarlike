@extends('layouts.adminBase')
@section('title','Sliders | Admin')
@section('Drivers','mm-active')
@section('driver_select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Drivers</h4>
                <span class="ms-auto"><a href="
                    {{ route('super.admin.add.driver.view') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add new</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-striped table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                {{-- <th>status</th> --}}
                                <th>Status</th>
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivers as $driver)
                                <tr>
                                    <td>{{ $driver->id }}</td>
                                    <td><img src="{{ asset('images/drivers/'.$driver->image) }}" class="rounded-10" style="height: 40px; width:40px;" alt=""></td>
                                    <td>{{ $driver->name }}</td>
                                    <td>{{ $driver->contact }}</td>
                                    <td>{{ $driver->email }}</td>
                                    <td>{{ $driver->address }}</td>
                                    <td>
                                        <form action="{{ route('super.admin.driver.active.deactive') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="driver_id" value="{{ $driver->id }}">
                                            @if ($driver->status == true)
                                                <button type="submit" class=" btn btn-dark badge btn-sm bg-success">Active</button>
                                            @else
                                                <button type="submit" class=" btn badge btn-sm bg-danger">Deactive</button>
                                            @endif
                                        </form>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('super.admin.delete.driver') }}" method="POST">
                                                @csrf
                                                <input type="text" name="driver_id" value="{{ $driver->id }}" hidden>
                                                <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                            </form>
                                            {{-- <a href="{{ route() }}" data-bs-toggle="modal" data-bs-target="#editUser" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a> --}}
                                            <form action="" method="get">
                                                <input type="text" name="user_id" value="{{ $driver->id }}" hidden>
                                                <button class="btn btn-sm btn-info"><i class="bx bx-edit"></i></button>
                                            </form>
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
