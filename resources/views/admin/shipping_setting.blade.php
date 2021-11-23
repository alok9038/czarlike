@extends('layouts.adminBase')
@section('title','Shipping  | Admin')
@section('shipping','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Shipping</h4>
                {{-- <span class="ms-auto"><a href="
                    {{ route('super.admin.slider.view.create') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Create</a></span> --}}
            </div>
            <form action="" method="post">
            <div class="card-body">
                <div class="cod mb-4">
                    <h5 class="mb-3">Cash On Delivery (Cod)</h5>
                        <div class="mb-3">
                            <label for="cod_charge" class="fw-bold">Cod Charge</label>
                            <input type="number" name="cod_charge" value="{{ ship_set()->cod_charge }}" class="form-control shadow-none" id="cod_charge">
                            <p class="small text-muted"><strong>Note:</strong> If you want to free cod then set cod charge to 0.</p>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="cod_charge" class="fw-bold">Min Charge</label>
                            <input type="number" name="cod_charge" class="form-control shadow-none" id="cod_charge">
                        </div> --}}
                        {{-- <div class="mb-3">
                            <input type="submit" value="Save" class="btn btn-dark float-end">
                        </div> --}}
                </div>
                <hr>
                <div class="cod mb-4">
                    <h5 class="mb-3">Shipping Charge</h5>
                        <div class="mb-3">
                            <label for="ship_charge" class="fw-bold">Charge</label>
                            <input type="number" name="shipping_charge" value="{{ ship_set()->shipping_charge }}" class="form-control shadow-none" id="ship_charge">
                        </div>
                        <div class="mb-3">
                            <label for="max_cart_amount" class="fw-bold">Max Cart Amount (optional)</label>
                            <input type="number" name="max_cart_amount" value="{{ ship_set()->max_cart_amount }}" class="form-control shadow-none" id="max_cart_amount">
                            <p class="small text-muted"><strong>Note:</strong> Shipping Charge only applicable on those orders which are less then this amount.</p>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="cod_charge" class="fw-bold">Min Charge</label>
                            <input type="number" name="cod_charge" class="form-control shadow-none" id="cod_charge">
                        </div> --}}
                        <div class="mb-3">
                            <input type="submit" value="Save" class="btn btn-dark float-end">
                        </div>
                    </div>
                </div>
            </form>
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
