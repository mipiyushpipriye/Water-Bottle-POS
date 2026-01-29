@extends('adminlte::page')

@section('title', 'Add Brand')

@section('content_header')
<h1>Add Brand</h1>
@endsection

@section('content')
<form action="{{ route('brands.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Brand Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter brand name">
    </div>
    <button type="submit" class="btn btn-success">Add Brand</button>
</form>
@endsection
