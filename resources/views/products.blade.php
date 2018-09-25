@extends('app')

@yield('header')

@section('content')
    <div class="row">
        @include('products.grid', ['products' => $products])
    <div>
@endsection