@extends('layouts.adminBase')
@section('title','All Coupons | Admin')
@section('product_management','mm-active')
@section('coupons-select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">All Coupons</h4>
                <span class="ms-auto"><a href="
                    {{ route('super.admin.view.add.coupon') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add new</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-borderless" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>id#</th>
                                <th>Coupon Code</th>
                                <th>Status</th>
                                <th>Discount Percentage</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>valid till</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $coupons as $coupon )
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{-- <div>
                                            <input class="form-check-input me-3" type="checkbox" value="" aria-label="...">
                                        </div> --}}
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14">#COU-000{{ $coupon->id }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $coupon->code }}</td>
                                <td>
                                    @if ($coupon->status == 1)
                                    <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>active</div>
                                    @else
                                    <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>deactive</div>
                                    @endif
                                </td>
                                <td>{{ $coupon->amount }}<b>%</b></td>
                                @if ($coupon->cat_id !== null)
                                <td>{{ $coupon->category->title }}</td>
                                @else
                                <td>------------</td>
                                @endif
                                @if ($coupon->product_id !== null)
                                <td>{{ $coupon->products->name }}</td>
                                @else
                                <td>------------</td>
                                @endif
                                <td>{{ $expiry_date = date('Y-m-d', strtotime($coupon->expirydate)); }}</td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{ route('super.admin.view.edit.coupon',['coupon_id'=>$coupon->id]) }}" class="ms-3"><i class='bx bxs-edit'></i></a>
                                        <form action="{{ route('super.admin.delete.coupon') }}" method="POST" id="delete_coupon">
                                            @csrf
                                            <input type="text" value="{{ $coupon->id }}" hidden name="coupon_id">
                                        </form>
                                        <a href="#" onclick="javascript:$('#delete_coupon').submit();" class="ms-3"><i class='bx bxs-trash'></i></a>
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
