@extends('adminlte::page')

@section('title', 'Add Stock')

@section('content_header')
<h1>Add / Remove Stock</h1>
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

<form action="{{ route('stock.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Product</label>
        <select name="product_id" class="form-control">
            <option value="">Select Product</option>
            @foreach($products as $product)
            <option value="{{ $product->id }}">
                {{ $product->brand->name }} - {{ $product->size }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Type</label>
        <select name="type" class="form-control">
            <option value="IN">Add Stock</option>
            <option value="OUT">Remove Stock</option>
        </select>
    </div>

    <div class="form-group">
        <label>Number of Boxes</label>
        <input type="number" name="boxes" class="form-control" placeholder="Enter number of boxes" min="1">
    </div>

    <div class="form-group">
        <label>Reason (Optional)</label>
        <input type="text" name="reason" class="form-control" placeholder="Purchase, Sale, Adjustment...">
    </div>

    <button type="submit" class="btn btn-success">Update Stock</button>
</form>

@endsection
