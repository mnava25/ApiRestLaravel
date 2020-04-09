@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2 class="display-d">Products</h2>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-4">
                    <a href="{{ route('products.show',['title' => $product->title,'id'=>$product->identifier ]) }}">
                        <div class="card">
                            <img class="card-img-top" src="{{ $product->picture }}" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->title }} ({{ $product->stock }})</h5>
                                <p class="card-text">{{ $product->details }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
