@extends('layouts.adminBase')
@section('title','All Orders | Admin')
@section('orders','mm-active')
@section('returned_orders','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">All Orders</h4>
                {{-- <span class="ms-auto"><a href="
                    {{ route('super.admin.add.driver.view') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add new</a></span> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-borderless" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>Order#</th>
                                <th>Customer Name</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Order Type</th>
                                <th>Qty</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $orders as $order )
                                @foreach ($order->cart_item as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input me-3" type="checkbox" value="" aria-label="...">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">#OS-000{{ $item->cartItems->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->cartItems->name }}</td>
                                    <td><div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>pending</div></td>
                                    <td>₹ {{ $order->payments->amount }}</td>
                                    <td>
                                        @if ($order->payment_status == 1)
                                            <span class="bg-light-info text-info mx-auto badge">Prepaid</span>
                                        @else
                                            <span class="bg-light-info text-info mx-auto badge">COD</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->qty }}</td>
                                    <td>June 10, 2020</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('super.admin.view.orders',['order_id'=>$item->id]) }}" class=""><i class='lni lni-eye'></i></a>
                                            <a href="javascript:;" class="ms-3"><i class='bx bxs-edit'></i></a>
                                            <a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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
