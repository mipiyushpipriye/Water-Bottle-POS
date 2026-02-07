@extends('adminlte::page')

@section('title', 'Payments')

@section('content_header')
<h1>All Payments</h1>
<a href="{{ route('payments.create') }}" class="btn btn-primary mb-2">Add Payment</a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Bill No</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->id }}</td>
            <td>{{ $payment->sale->customer->name ?? '' }}</td>
            <td>{{ $payment->sale->bill_no }}</td>
            <td>₹{{ $payment->amount }}</td>
            <td>{{ $payment->method }}</td>
            <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
