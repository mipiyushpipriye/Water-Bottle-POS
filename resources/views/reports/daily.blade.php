@extends('adminlte::page')

@section('title', 'Daily Report')

@section('content_header')
<h1>Daily Report</h1>
@endsection

@section('content')

<form method="GET" class="form-inline mb-3">
    <label for="date" class="mr-2">Select Date:</label>
    <input type="date" name="date" id="date" value="{{ $date }}" class="form-control mr-2">
    <button type="submit" class="btn btn-primary">Filter</button>
</form>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Customer</th>
            <th>Bill No</th>
            <th>Date</th>
            <th>Sub Total</th>
            <th>Discount</th>
            <th>Grand Total</th>
            <th>Products</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->customer->name ?? '' }}</td>
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
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
