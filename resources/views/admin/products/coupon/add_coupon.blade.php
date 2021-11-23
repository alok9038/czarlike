@extends('layouts.adminBase')
@section('title','All Coupons | Admin')
@section('product_management','mm-active')
@section('coupons-select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Add Coupon</h4>
                <span class="ms-auto"><a href="
                    {{ route('super.admin.coupons') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Back</a></span>
            </div>
            <div class="card-body">
                <form action="{{ route('super.admin.add.coupon') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="code" class="fw-bold">Code <span class="text-danger">*</span></label>
                        <input type="text" name="code" class="form-control shadow-none">
                        @error('code')
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="fw-bold">percentage <span class="text-danger">*</span></label>
                        <input type="text" name="amount" class="form-control shadow-none">
                        @error('amount')
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cat_id" class="fw-bold">Category (optional)</label>
                        <select name="cat_id" id="cat_id" class="form-select shadow-none">
                            <option value="" selected hidden disabled>select</option>
                            @foreach (categories() as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                            @endforeach
                        </select>
                        <p class="small"><strong>Note: </strong> if you select category coupon will only work this category</p>
                    </div>
                    <div class="mb-3">
                        <label for="product_id" class="fw-bold">Product</label>
                        <select name="product_id" id="product_id" class="form-select shadow-none">
                            <option value="" selected hidden disabled>select</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <p class="small"><strong>Note: </strong> if you select category coupon will only work this Product</p>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="min_amount" class="fw-bold">Minumum Cart Amount </label>
                            <input type="text" name="min_amount" class="form-control shadow-none">
                            @error('amount')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col">
                            <label for="expiry_date" class="fw-bold">Expiry Date </label>
                            <input type="date" name="expiry_date" class="form-control shadow-none">
                            @error('amount')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-dark float-end"><i class="bx bx-plus"></i>Add</button>
                    </div>
                </form>
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
