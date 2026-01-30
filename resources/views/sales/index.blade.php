@extends('adminlte::page')

@section('title', 'Sales')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>All Sales</h1>
    <a href="{{ route('sales.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Sale
    </a>
</div>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- DESKTOP TABLE --}}
<div class="d-none d-md-block">
    <table class="table table-bordered table-striped">
        <thead class="bg-light">
            <tr>
                <th>Bill No</th>
                <th>Date</th>
                <th>Sub Total</th>
                <th>Discount</th>
                <th>Grand Total</th>
                <th>Paid</th>
                <th>Remaining</th>
                <th>Products</th>
                <th>Payments</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
            @php
                $paid = $sale->payments->sum('amount');
                $remaining = $sale->grand_total - $paid;
            @endphp
            <tr>
                <td><strong>{{ $sale->bill_no }}</strong></td>
                <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</td>
                <td>₹{{ number_format($sale->sub_total, 2) }}</td>
                <td>₹{{ number_format($sale->discount, 2) }}</td>
                <td class="text-success font-weight-bold">₹{{ number_format($sale->grand_total, 2) }}</td>

                <td class="text-primary">
                    ₹{{ number_format($paid, 2) }}
                </td>

                <td class="{{ $remaining > 0 ? 'text-danger font-weight-bold' : 'text-success' }}">
                    ₹{{ number_format($remaining, 2) }}
                </td>
                <td>
                    <ul class="mb-0">
                        @foreach($sale->items as $item)
                        <li>
                            {{ $item->product->brand->name }} {{ $item->product->size }} 
                            - {{ $item->boxes }} boxes @ ₹{{ $item->rate }}
                        </li>
                        @endforeach
                    </ul>
                </td>

                <td>
                    <ul class="mb-0">
                        @foreach($sale->payments as $payment)
                        <li>{{ $payment->method }}: ₹{{ $payment->amount }}</li>
                        @endforeach
                    </ul>
                </td>

                <td>
                    <a href="{{ route('sales.print', $sale->id) }}" target="_blank" class="btn btn-sm btn-success">
                        <i class="fas fa-print"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MOBILE CARDS --}}
<div class="d-block d-md-none">
    @foreach($sales as $sale)
    @php
        $paid = $sale->payments->sum('amount');
        $remaining = $sale->grand_total - $paid;
    @endphp
    <div class="card mb-3 shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between">
                <strong>Bill #{{ $sale->bill_no }}</strong>
                <span class="text-muted">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y') }}</span>
            </div>

            <hr class="my-2">

            <p class="mb-1">Sub Total: ₹{{ number_format($sale->sub_total, 2) }}</p>
            <p class="mb-1">Discount: ₹{{ number_format($sale->discount, 2) }}</p>
            <p class="mb-2 text-success font-weight-bold">
                Grand Total: ₹{{ number_format($sale->grand_total, 2) }}
            </p>
            <p class="mb-1 text-primary">Paid: ₹{{ number_format($paid, 2) }}</p>

            <p class="mb-2 {{ $remaining > 0 ? 'text-danger font-weight-bold' : 'text-success' }}">
                Remaining: ₹{{ number_format($remaining, 2) }}
            </p>

            <strong>Products</strong>
            <ul class="pl-3">
                @foreach($sale->items as $item)
                <li class="small">
                    {{ $item->product->brand->name }} {{ $item->product->size }} 
                    - {{ $item->boxes }} boxes @ ₹{{ $item->rate }}
                </li>
                @endforeach
            </ul>

            <strong>Payments</strong>
            <ul class="pl-3">
                @foreach($sale->payments as $payment)
                <li class="small">{{ $payment->method }}: ₹{{ $payment->amount }}</li>
                @endforeach
            </ul>

            <a href="{{ route('sales.print', $sale->id) }}" target="_blank" class="btn btn-success btn-block mt-2">
                <i class="fas fa-print"></i> Print Bill
            </a>

        </div>
    </div>
    @endforeach
</div>

@endsection
