@extends('adminlte::page')

@section('title', 'Customers')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Customers</h1>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">
        <i class="fas fa-user-plus"></i> Add Customer
    </a>
</div>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $customer->name }}</strong></td>
                    <td>{{ $customer->phone ?? '-' }}</td>
                    <td>{{ $customer->address ?? '-' }}</td>
                    <td>
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No customers found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
