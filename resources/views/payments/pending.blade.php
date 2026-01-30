@extends('adminlte::page')

@section('title', 'Pending Payments')

@section('content_header')
<h1>Pending Payments</h1>
@endsection

@section('content')

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Bill No</th>
            <th>Date</th>
            <th>Grand Total</th>
            <th>Paid</th>
            <th>Remaining</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
            @php
                $paid = $sale->payments_sum_amount ?? 0;
                $remaining = $sale->grand_total - $paid;
            @endphp
            <tr>
                <td>{{ $sale->bill_no }}</td>
                <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</td>
                <td>₹{{ number_format($sale->grand_total, 2) }}</td>
                <td>₹{{ number_format($paid, 2) }}</td>
                <td class="text-danger font-weight-bold">₹{{ number_format($remaining, 2) }}</td>
                <td>
                    <a href="{{ route('payments.create') }}?sale_id={{ $sale->id }}" class="btn btn-sm btn-success">
                        Add Payment
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@if($sales->count() == 0)
    <div class="alert alert-success">🎉 No pending payments!</div>
@endif

@endsection
