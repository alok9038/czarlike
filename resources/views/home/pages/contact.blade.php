@extends('layouts.base')
@section('page_title','Contact us')
@section('content')

    <div class="container my-5">
        <div class="card border-0 shadow-sm order-card mb-3" style="border-radius: 10px;">
            <h4 class="text-center mt-4">Contact us</h4>
            <div class="card-body">
                <form action="{{ route('contact.us.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="fw-bold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="shadow-none form-control">
                        @error('name')
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="phone" class="fw-bold">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone" class="shadow-none form-control">
                            @error('phone')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col">
                            <label for="email" class="fw-bold">Email <span class="text-danger">*</span></label>
                            <input type="text" name="email" id="email" class="shadow-none form-control">
                            @error('email')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="fw-bold">Message</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Submit" class="btn btn-dark float-end">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
