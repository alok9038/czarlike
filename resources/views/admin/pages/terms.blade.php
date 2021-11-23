@extends('layouts.adminBase')
@section('title','About us | Admin')
@section('pages_select','mm-active')
@section('t&c','mm-active')
@section('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<style>
    .ff_fileupload_start_upload{
        display: none!important;
    }
</style>
@endsection

@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Terms & Conditions</h4>
                {{-- <span class="ms-auto"><a href="{{ route('super.admin.product.view') }}" class="btn btn-secondary btn-sm"><i class="bx bx-left-arrow"></i>back</a></span> --}}
            </div>
            <div class="card-body">
                <div class="col-12 mx-auto">
                    <form action="{{ route('super.admin.store.term') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="description" class="fw-bold">Page Content</label>
                            <textarea name="content" id="description" cols="30" rows="10" class="form-control h-100 shadow-none tinymce-editor">
                                <?= pages()->t_and_c; ?>
                            </textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark btn-sm float-end">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('js')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>
    @endsection
@endsection
