@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <i class="bi bi-receipt-cutoff h1"></i>
                    </div>
                    <div class="card-body">
                        <h4> {{ __('messages.ProductDetails') }}</h4>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <i class="bi bi-box-seam h1"></i>
                    </div>
                    <div class="card-body">
                        <h4>{{ __('messages.Products') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
