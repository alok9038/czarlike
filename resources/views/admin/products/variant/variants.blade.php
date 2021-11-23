@extends('layouts.adminBase')
@section('title','Products | Admin')
@section('product_management','mm-active')
@section('product-select','mm-active')
@section('content')
    <div class="container my-4">
        <h5 class="my-3">
            @if ($variants->count() > 0)
                {{ $variants[0]->product->name }}
            @endif
        </h5>
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Variants</h4>
                <span class="ms-auto">
                        <a href="{{ route('super.admin.add.variant.view',['variant_id'=>Request::route('variant_id')]) }}" class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add new</a>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-striped table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                {{-- <th>Image</th> --}}
                                <th>product Details</th>
                                <th>Price</th>
                                <th>mrp</th>
                                <th>Stock Status</th>
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                           @if ($variants->count() > 0)
                           @foreach ($variants as $product)
                           <tr>
                               <td>{{ $product->id }}</td>
                               <td>
                                   <div>
                                       @if ($product->size !== null)
                                       <div class="d-flex mt-2">
                                            <div class=" small"><strong>size:</strong></div>
                                            <div class="ms-2 small">{{ $product->vSize->size }}</div>
                                        </div>
                                       @endif
                                       @if ($product->color !== null)
                                       <div class="d-flex mt-2">
                                           <div class=" small"><strong>Color:</strong></div>
                                           <div class="ms-2 small p-2 rounded-circle" style="background-color: {{ $product->vColor->color }}"></div>
                                       </div>
                                       @endif
                                   </div>
                               </td>
                               <td>
                                   <div class="ms-2 small">₹ {{ $product->price }}</div>
                               </td>
                               <td>₹ {{ $product->mrp }}</td>
                               <td>
                                   <form action="{{ route('super.admin.product.stock.status') }}" method="post">
                                       @csrf
                                       @method('put')
                                       <input type="hidden" name="variant_id" value="{{ $product->id }}">
                                        @if ($product->stock_status == 1)
                                            <input type="hidden" name="s_status" value="1">
                                            <button class="btn btn-sm btn-info">In stock</button>
                                        @else
                                            <input type="hidden" name="s_status" value="0">
                                            <button class="btn btn-sm btn-danger">out of stock</button>
                                        @endif
                                   </form>
                               </td>
                               <td>
                                   <div class="btn-group">
                                       <form action="{{ route('super.admin.delete.variant') }}" method="POST">
                                           @csrf
                                           <input type="text" name="variant_id" value="{{ $product->id }}" hidden>
                                           <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                       </form>
                                       <a href="{{ route('super.admin.product.edit.variant.view',['product_id'=>$product->product_id,'variant_id'=>$product->id]) }}" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a>
                                   </div>
                               </td>
                           </tr>
                           @endforeach
                           @endif
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
	</script>
    @endsection
@endsection
