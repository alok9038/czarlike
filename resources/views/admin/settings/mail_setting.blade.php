@extends('layouts.adminBase')
@section('title','Payment Settings | Admin')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Mail Settings</h4>
                {{-- <span class="ms-auto"><a href="
                    {{ route('super.admin.slider.view.create') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Create</a></span> --}}
            </div>
            <div class="card-body">
                <form action="{{ route('super.admin.mail.update') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="fw-bold" for="MAIL_FROM_NAME">Sender Name :</label>
                                <input type="text" name="MAIL_FROM_NAME" id="MAIL_FROM_NAME" value="{{ env('MAIL_FROM_NAME') }}" class="form-control shadow-none">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="fw-bold" for="MAIL_DRIVER">Mail Driver: (ex. smtp, sendmail, mail)</label>
                                <input type="text" name="MAIL_DRIVER" id="MAIL_DRIVER" value="{{ env('MAIL_DRIVER') }}" class="form-control shadow-none">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="fw-bold" for="MAIL_FROM_ADDRESS">Mail Address : (ex.alok@info.com)</label>
                                <input type="email" name="MAIL_FROM_ADDRESS" id="MAIL_FROM_ADDRESS" value="{{ env('MAIL_FROM_ADDRESS') }}" class="form-control shadow-none">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="fw-bold" for="MAIL_HOST">Mail Host: (ex. smtp.google.com)</label>
                                <input type="text" name="MAIL_HOST" id="MAIL_HOST" value="{{ env('MAIL_HOST') }}" class="form-control shadow-none">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="fw-bold" for="MAIL_PORT">Mail PORT : (ex.467, 587, 2525)</label>
                                <input type="number" name="MAIL_PORT" id="MAIL_PORT" value="{{ env('MAIL_PORT') }}" class="form-control shadow-none">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="fw-bold" for="MAIL_USERNAME">Mail Username: (ex. alok@gmail.com)</label>
                                <input type="text" name="MAIL_USERNAME" id="MAIL_USERNAME" value="{{ env('MAIL_USERNAME') }}" class="form-control shadow-none">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="fw-bold" for="MAIL_PASSWORD">Mail Password : </label>
                                <input type="email" name="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}" id="MAIL_PASSWORD" class="form-control shadow-none">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="fw-bold" for="MAIL_ENCRYPTION">Mail Encryption: (ex. TLS,SSL,OR Leave blank)</label>
                                <input type="text" name="MAIL_ENCRYPTION" value="{{ env('MAIL_ENCRYPTION') }}" id="MAIL_ENCRYPTION" class="form-control shadow-none">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-sm btn-dark float-end">Save Setting</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
