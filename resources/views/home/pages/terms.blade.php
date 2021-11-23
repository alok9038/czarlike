@extends('layouts.base')
@section('page_title','Terms and conditions')
@section('content')

    <div class="container my-5">
        <div class="card border-0 shadow-sm order-card mb-3" style="border-radius: 10px;">
            <div class="card-body">
                <?= pages()->t_and_c; ?>
            </div>
        </div>
    </div>
@endsection
