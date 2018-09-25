@extends('app')

@section('content')
    <h2 style="text-align: center">Search Results</h2>
    <div class="row">
        @include('products.grid', ['products' => $products])
    <div>
@endsection