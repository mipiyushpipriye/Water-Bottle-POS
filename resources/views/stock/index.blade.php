@extends('adminlte::page')

@section('title', 'Stock Management')

@section('content_header')
<h1>Stock List</h1>
<a href="{{ route('stock.add') }}" class="btn btn-primary mb-2">Add / Remove Stock</a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Brand</th>
            <th>Product Size</th>
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
