@extends('layouts.sellerBase')
@section('title','Products | Seller')
@section('product_management','mm-active')
@section('product-select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">All products</h4>
                <span class="ms-auto">
                    <a href="{{ route('seller.product.create.view') }}" class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add new</a>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Image</th>
                                <th>product Details</th>
                                <th>Price</th>
                                <th>Categories</th>
                                <th>Featured</th>
                                <th>Status</th>
                                {{-- <th>Request For Delete</th> --}}
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><img src="{{ asset('images/products/'.$product->image) }}" class="rounded-10" style="height: 150px; width:130px;" alt=""></td>
                                <td>
                                    <div>
                                        <div class="d-flex">
                                            <div class=" small"><strong>{{ $product->name }}</strong></div>
                                            {{-- <div class="ms-2 small">{{ $product->product_name }}</div> --}}
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class=" small"><strong>Store:</strong></div>
                                            <div class="ms-2 small">{{ $product->store_id }}</div>
                                        </div>
                                        {{-- <div class="d-flex mt-2">
                                            <div class=" small"><strong>Brand:</strong></div>
                                            <div class=" ms-2 small">@if ($product->brand_id !== null)
                                                {{ $product->product_brand->brand_name }}
                                            @endif</div>
                                        </div> --}}
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="d-flex mt-2">
                                            <div class=" small"><strong>Price :</strong></div>
                                            <div class="ms-2 small">₹ {{ $product->price }}</div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class=" small"><strong>Offer Price:</strong></div>
                                            <div class=" ms-2 small">₹ {{ $product->offer_price }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="d-flex mt-2">
                                            <div class="ms-2 small fw-bold">{{ $product->product_cat->title }}</div>
                                        </div>
                                        @if ($product->sub_cat_id !== null)
                                        <div class="d-flex mt-2">
                                            <div class=" ms-2 small fw-bold">{{ $product->product_cat->sub_cat->title }}</div>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if (Auth::user()->user_type == 'seller')
                                        @if ($product->featured == 1)
                                            <span class="badge bg-light-success text-success">yes</span>
                                        @else
                                            <span class="badge bg-light-danger text-danger">no</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if (Auth::user()->user_type == 'seller')
                                        @if ($product->status == 1)
                                            <span class="badge bg-light-success text-success">Active</span>
                                        @else
                                            <span class="badge bg-light-danger text-danger">Deactive</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('super.admin.product.delete') }}" method="POST">
                                            @csrf
                                            <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                                            <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                        </form>
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
