@extends('layouts.base')
@section('page_title','Refund, Return and Cancellation')
@section('content')

    <div class="container my-5">
        <div class="card border-0 shadow-sm order-card mb-3" style="border-radius: 10px;">
            <div class="card-body">
                <?= pages()->rrc; ?>
            </div>
        </div>
    </div>
@endsection
