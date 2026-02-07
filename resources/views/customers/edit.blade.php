@extends('adminlte::page')

@section('title', 'Edit Customer')

@section('content_header')
<h1>Edit Customer</h1>
@endsection

@section('content')

<div class="card col-md-6 mx-auto">
    <div class="card-body">

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Customer Name *</label>
                <input type="text" name="name" class="form-control" value="{{ $customer->name }}" required>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}">
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control" rows="3">{{ $customer->address }}</textarea>
            </div>

            <div class="text-right">
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Update Customer</button>
            </div>

        </form>

    </div>
</div>

@endsection
