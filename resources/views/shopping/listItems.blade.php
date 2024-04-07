@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach ($data as $item)
            <div class="col-sm-3">
                <div class="card m-2">
                    <div class="card-header">
                        <span class="badge text-bg-danger ">
                            {{ $item->discount }} %
                        </span>
                        <img src="\assets\images\{{ $item->image }}" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->product_name }}</h5>
                        <p class="card-text">{{ $item->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $item->color }}</li>
                        <li class="list-group-item">
                            <span class="card-text text-danger">
                                <del>${{ $item->total }}</del>
                            </span>
                            <span class="card-text"> ${{ $item->net }}</span>

                        </li>
                    </ul>
                    <div class="card-footer">
                        <a href="{{ route('details', ['id' => $item->id]) }}" class="btn btn-primary">Go somewhere</a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
