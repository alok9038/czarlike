@extends('layouts.sellerBase')
@section('title','Countries | Admin')
@section('stores','mm-active')
@section('store_select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">All Stores</h4>
                <span class="ms-auto"><a href="
                    {{ route('seller.create.store.view') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add new</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-striped table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Store Logo</th>
                                <th>Store Details</th>
                                <th>Owner</th>
                                <th>status</th>
                                <th>Store Request Accepted?</th>
                                {{-- <th>Request For Delete</th> --}}
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stores as $store)
                            <tr>
                                <td>{{ $store->id }}</td>
                                <td><img src="{{ asset('users/stores/'.$store->store_logo) }}" class="rounded-10" style="height: 40px; width:40px;" alt=""></td>
                                <td>
                                    <div>
                                        <div class="d-flex">
                                            <div class=" small"><strong>Name:</strong></div>
                                            <div class="ms-2 small">{{ $store->store_name }}</div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class=" small"><strong>Email:</strong></div>
                                            <div class="ms-2 small">{{ $store->bussiness_email }}</div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class=" small"><strong>Phone:</strong></div>
                                            <div class=" ms-2 small">{{ $store->phone }}</div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class=" small"><strong>Address:</strong></div>
                                            <div class="ms-2 small">{{ Str::substr($store->store_address, 0, 10) }}</div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class=" small"><strong>Verified:</strong></div>
                                            <div class="ms-2 small">
                                                @if ($store->is_verified == '1')
                                                    <span class="badge bg-success">Yes</span>
                                                @else
                                                    <span class="badge bg-danger">No</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $store->storeOwner->user_name }}</td>
                                <td>
                                    @if ($store->status == '1')
                                        <span class="badge bg-success">active</span>
                                    @else
                                        <span class="badge bg-danger">Deactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($store->is_requested == '0')
                                        <span class="badge bg-light-success text-success">Yes</span>
                                    @else
                                        <span class="badge bg-light-danger text-danger">No</span>
                                    @endif
                                </td>
                                {{-- <td>no</td> --}}
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('seller.drop.store') }}" method="POST">
                                            @csrf
                                            <input type="text" name="store_id" value="{{ $store->id }}" hidden>
                                            <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                        {{-- <form action="{{ route('super.admin.update.store.view') }}" method="get">
                                            <input type="text" name="user_id" value="{{ $store->id }}" hidden>
                                            <button class="btn btn-sm btn-info"><i class="bx bx-edit"></i></button>
                                        </form> --}}
                                        {{-- <a href="{{ route('seller.update.store.view','store_id='.$store->id) }}" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a> --}}
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
