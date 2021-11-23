@extends('layouts.adminBase')
@section('title','Sliders | Admin')
@section('sliders','mm-active')
@section('slider_select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Sliders</h4>
                <span class="ms-auto"><a href="
                    {{ route('super.admin.slider.view.create') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Create</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive pt-2 px-2">
                    <table id="example2" class="table table-striped table-borderless" style="width:100%">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Slider Image</th>
                                <th>Slider Content</th>
                                <th>Status</th>
                                <th class="d-print-none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td>
                                    <img src="{{ asset('images/slider/'.$slider->image) }}" style="height: 100px; width:220px;" alt="{{ $slider->image }}">
                                </td>
                                <td>
                                    <div>
                                        <div class="d-flex">
                                            <div class=" small"><strong>Heading:</strong></div>
                                            <div class="ms-2 small">{{ $slider->heading_text }}</div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class=" small"><strong>Sub Heading:</strong></div>
                                            <div class="ms-2 small">{{ $slider->subheading_text }}</div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class=" small"><strong>Button text:</strong></div>
                                            <div class=" ms-2 small">{{ $slider->button_text }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $slider->status }}</td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('super.admin.drop.slider') }}" method="POST">
                                            @csrf
                                            <input type="text" name="slider_id" value="{{ $slider->id }}" hidden>
                                            <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                        {{-- <form action="{{ route('super.admin.update.slider.view') }}" method="get">
                                            <input type="text" name="user_id" value="{{ $slider->id }}" hidden>
                                            <button class="btn btn-sm btn-info"><i class="bx bx-edit"></i></button>
                                        </form> --}}
                                        <a href="{{ route('super.admin.update.slider.view','slider_id='.$slider->id) }}" class="btn btn-info btn-sm"><i class="bx bx-edit"></i></a>
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
