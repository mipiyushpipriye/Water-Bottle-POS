@extends('adminlte::page')

@section('title', 'Sales')

@section('content_header')
<h1>All Sales</h1>
<a href="{{ route('sales.create') }}" class="btn btn-primary mb-2">Add New Sale</a>
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif


<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Bill No</th>
            <th>Date</th>
            <th>Sub Total</th>
            <th>Discount</th>
            <th>Grand Total</th>
            <th>Products</th>
            <th>Payments</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->bill_no }}</td>
            <td>{{ $sale->sale_date }}</td>
            <td>₹{{ $sale->sub_total }}</td>
            <td>₹{{ $sale->discount }}</td>
            <td>₹{{ $sale->grand_total }}</td>
            <td>
                <ul>
                    @foreach($sale->items as $item)
                    <li>{{ $item->product->brand->name }} {{ $item->product->size }} - {{ $item->boxes }} boxes @ ₹{{ $item->rate }} each</li>
                    @endforeach
                </ul>
            </td>
            <td>
                <ul>
                    @foreach($sale->payments as $payment)
                    <li>{{ $payment->method }}: ₹{{ $payment->amount }}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                <a href="{{ route('sales.print', $sale->id) }}" target="_blank" class="btn btn-sm btn-success">
                    Print
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
