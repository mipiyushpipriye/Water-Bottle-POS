@extends('adminlte::page')

@section('title', 'Add Product')

@section('content_header')
<h1>Add New Bottle Box</h1>
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Brand</label>
        <select name="brand_id" class="form-control">
            <option value="">Select Brand</option>
            @foreach($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Size</label>
        <input type="text" name="size" class="form-control" placeholder="e.g. 200ml, 500ml, 1L">
    </div>

    <div class="form-group">
        <label>Quantity per Box</label>
        <input type="number" name="qty_per_box" class="form-control" placeholder="Bottles per box">
    </div>

    <div class="form-group">
        <label>Stock Boxes</label>
        <input type="number" name="stock_boxes" class="form-control" placeholder="Available boxes">
    </div>

    <div class="form-group">
        <label>Default Price (Optional)</label>
        <input type="number" step="0.01" name="default_price" class="form-control" placeholder="Default price per box">
    </div>

    <button type="submit" class="btn btn-success">Add Product</button>
</form>

@endsection
