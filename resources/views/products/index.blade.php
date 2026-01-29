@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
<h1>All Products</h1>
<a href="{{ route('products.create') }}" class="btn btn-primary mb-2">Add New Product</a>
@endsection

@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Brand</th>
            <th>Size</th>
            <th>Qty per Box</th>
            <th>Stock Boxes</th>
            <th>Default Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->brand->name }}</td>
            <td>{{ $product->size }}</td>
            <td>{{ $product->qty_per_box }}</td>
            <td>{{ $product->stock_boxes }}</td>
            <td>{{ $product->default_price ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
