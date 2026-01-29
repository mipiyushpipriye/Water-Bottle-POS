@extends('adminlte::page')

@section('title', 'Add Payment')

@section('content_header')
<h1>Add Payment</h1>
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('payments.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Sale Bill</label>
        <select name="sale_id" class="form-control">
            <option value="">Select Sale</option>
            @foreach($sales as $sale)
            @php
                $paid = $sale->payments_sum_amount ?? 0;
                $remaining = $sale->grand_total - $paid;
            @endphp
                <option value="{{ $sale->id }}">
                    {{ $sale->bill_no }} (Remaining: ₹{{ $remaining }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Amount</label>
        <input type="number" step="0.01" name="amount" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Payment Method</label>
        <select name="method" class="form-control" required>
            <option value="">Select Method</option>
            <option value="Cash">Cash</option>
            <option value="UPI">UPI</option>
            <option value="Card">Card</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Save Payment</button>
</form>

@endsection
