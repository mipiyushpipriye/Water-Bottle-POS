@extends('adminlte::page')

@section('title', 'Add Customer')

@section('content_header')
<h1>Add Customer</h1>
@endsection

@section('content')

<div class="card col-md-6 mx-auto">
    <div class="card-body">

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Customer Name *</label>
                <input type="text" name="name" class="form-control" required placeholder="Enter customer name">
            </div>

            <div class="form-group">
                <label>Phone (Optional)</label>
                <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
            </div>

            <div class="form-group">
                <label>Address (Optional)</label>
                <textarea name="address" class="form-control" rows="3" placeholder="Enter address"></textarea>
            </div>

            <div class="text-right">
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Save Customer</button>
            </div>

        </form>

    </div>
</div>

@endsection
