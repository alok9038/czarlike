@extends('layouts.adminBase')
@section('title','Payment Settings | Admin')
@section('payment_select','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Payment Settings</h4>
                {{-- <span class="ms-auto"><a href="
                    {{ route('super.admin.slider.view.create') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Create</a></span> --}}
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-primary" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bxs-credit-card-alt font-18 me-1'></i></i>
                                </div>
                                <div class="tab-title">Paytm </div>
                                <div class="tab-icon"><i class='bx bxs-circle ms-3 {{ $config->paytm_enable==0 ? 'text-danger' : "text-success"}} font-18 me-1'></i></i></div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bxs-credit-card font-18 me-1'></i>
                                </div>
                                <div class="tab-title">RazorPay</div>
                                <div class="tab-icon"><i class='bx bxs-circle ms-3 {{ $config->razorpay_enable==0 ? 'text-danger' : "text-success"}} font-18 me-1'></i></i></div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-microphone font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Stripe</div>
                                <div class="tab-icon"><i class='bx bxs-circle ms-3 {{ $config->stripe_enable==0 ? 'text-danger' : "text-success"}} font-18 me-1'></i></i></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content py-3">
                    <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                        <div class="div">
                            <form action="{{ route('super.admin.update.paytm.settings') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="PAYTM_ENVIRONMENT" class="fw-bold">PAYTM ENVIRONMENT: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control shadow-none" value="{{ env('PAYTM_ENVIRONMENT') }}" id="PAYTM_ENVIRONMENT" name="PAYTM_ENVIRONMENT">
                                    <p class="text-muted small">For Live use production and for Test use local as ENVIRONMENT</p>
                                </div>
                                <div class="mb-3">
                                    <label for="PAYTM_MERCHANT_ID" class="fw-bold">PAYTM MERCHANT ID: <span class="text-danger">*</span></label>
                                    <input type="text" id="PAYTM_MERCHANT_ID" value="{{ env('PAYTM_MERCHANT_ID') }}" class="form-control shadow-none" name="PAYTM_MERCHANT_ID">
                                </div>
                                <div class="mb-3">
                                    <label for="PAYTM_MERCHANT_KEY" class="fw-bold">PAYTM MERCHANT KEY: <span class="text-danger">*</span> : </label>
                                    <input type="text" id="PAYTM_MERCHANT_KEY" value="{{ env('PAYTM_MERCHANT_KEY') }}" class="form-control shadow-none" name="PAYTM_MERCHANT_KEY">
                                </div>
                                <div class="mb-3">
                                        @if ($config->paytm_enable == 1)
                                        <label for="status" class="fw-bold">Status</label>
                                        <label class="switch">
                                            <input type="checkbox" value="1" checked name="paytmchk">
                                            <span class="slider"></span>
                                        </label>
                                        @else
                                        <label for="status" class="fw-bold">Status</label>
                                        <label class="switch">
                                            <input type="checkbox" value="1" name="paytmchk">
                                            <span class="slider"></span>
                                        </label>
                                        @endif
                                    <p class="small text-muted mt-4">(Enable to activate Paytm Payment gateway )                                    </p>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-dark sm float-end">Save setting</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                        <form action="{{ route('super.admin.update.razorpay.settings') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="RAZOR_PAY_KEY" class="fw-bold">RazorPay Key: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-none" value="{{ env('RAZOR_PAY_KEY') }}" id="RAZOR_PAY_KEY" name="RAZOR_PAY_KEY">
                                <p class="text-muted small">For Live use production and for Test use local as ENVIRONMENT</p>
                            </div>
                            <div class="mb-3">
                                <label for="RAZOR_PAY_SECRET" class="fw-bold">RazorPay Secret Key: <span class="text-danger">*</span></label>
                                <input type="text" id="RAZOR_PAY_SECRET" value="{{ env('RAZOR_PAY_SECRET') }}" class="form-control shadow-none" name="RAZOR_PAY_SECRET">
                            </div>
                            <div class="mb-3">
                                @if ($config->razorpay_enable == 1)
                                <label for="status" class="fw-bold">Status</label>
                                <label class="switch">
                                    <input type="checkbox" value="1" checked name="rpaycheck">
                                    <span class="slider"></span>
                                </label>
                                @else
                                <label for="status" class="fw-bold">Status</label>
                                <label class="switch">
                                    <input type="checkbox" value="1" name="rpaycheck">
                                    <span class="slider"></span>
                                </label>
                                @endif
                                <p class="small text-muted mt-4">(Enable to activate Razorpay Payment gateway )</p>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-dark sm float-end">Save setting</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                        <form action="{{ route('super.admin.update.stripe.settings') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="STRIPE_KEY" class="fw-bold">STRIPE KEY: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-none" value="{{ env('STRIPE_KEY') }}" id="STRIPE_KEY" name="STRIPE_KEY">
                            </div>
                            <div class="mb-3">
                                <label for="STRIPE_SECRET" class="fw-bold">STRIPE SECRET: <span class="text-danger">*</span></label>
                                <input type="text" id="STRIPE_SECRET" value="{{ env('STRIPE_SECRET') }}" class="form-control shadow-none" name="STRIPE_SECRET">
                            </div>
                            <div class="mb-3">
                                @if ($config->stripe_enable == 1)
                                    <label for="status" class="fw-bold">Status</label>
                                    <label class="switch">
                                        <input type="checkbox" value="1" checked name="stripecheck">
                                        <span class="slider"></span>
                                    </label>
                                @else
                                    <label for="status" class="fw-bold">Status</label>
                                    <label class="switch">
                                        <input type="checkbox" value="1" name="stripecheck">
                                        <span class="slider"></span>
                                    </label>
                                @endif
                                <p class="small text-muted mt-4">(Enable to activate Stripe Payment gateway )</p>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-dark sm float-end">Save setting</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
