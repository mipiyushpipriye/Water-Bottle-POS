<!DOCTYPE html>
<html>
<head>
    <title>Bill - {{ $sale->bill_no }}</title>
    <style>
        /* Mobile/thermal printer friendly */
        body {
            font-family: monospace;
            width: 280px; /* typical thermal printer width */
            margin: 0 auto;
            padding: 5px;
            font-size: 14px;
        }
        .header {
            text-align: center;
        }
        .header img {
            max-width: 100px;
            max-height: 80px;
        }
        h2, h3 {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 3px 0;
            text-align: left;
        }
        .right {
            text-align: right;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
    </style>
</head>
<body onload="window.print()">

<div class="header">
    <img src="{{ asset('images/logo.PNG') }}" alt="Logo">
    <h2>Siddhivinayak Enterprises</h2>
</div>

<h3>Bill: {{ $sale->bill_no }}</h3>
<p>Date: {{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</p>
<div class="line"></div>

<table>
    <thead>
        <tr>
            <th>Item</th>
            <th class="right">Qty</th>
            <th class="right">Rate</th>
            <th class="right">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sale->items as $item)
        <tr>
            <td>{{ $item->product->brand->name }} {{ $item->product->size }}</td>
            <td class="right">{{ $item->boxes }}</td>
            <td class="right">₹{{ number_format($item->rate,2) }}</td>
            <td class="right">₹{{ number_format($item->total,2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="line"></div>

<table>
    <tr>
        <td>Sub Total</td>
        <td class="right">₹{{ number_format($sale->sub_total,2) }}</td>
    </tr>
    <tr>
        <td>Discount</td>
        <td class="right">₹{{ number_format($sale->discount,2) }}</td>
    </tr>
    <tr>
        <td>Grand Total</td>
        <td class="right">₹{{ number_format($sale->grand_total,2) }}</td>
    </tr>
    <tr>
        <td>Paid</td>
        <td class="right">₹{{ number_format($paid,2) }}</td>
    </tr>
    <tr>
        <td>Remaining</td>
        <td class="right">₹{{ number_format($remaining,2) }}</td>
    </tr>
</table>

<div class="line"></div>
<p style="text-align:center;">Thank You! Visit Again</p>

</body>
</html>
