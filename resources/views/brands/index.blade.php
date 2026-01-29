@extends('adminlte::page')

@section('title', 'Brands')

@section('content_header')
<h1>All Brands</h1>
<a href="{{ route('brands.create') }}" class="btn btn-primary mb-2">Add Brand</a>
@endsection

@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach($brands as $brand)
        <tr>
            <td>{{ $brand->id }}</td>
            <td>{{ $brand->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
