@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalProducts }}</h3>
                <p>Total Products</p>
            </div>
            <div class="icon">
                <i class="fas fa-boxes"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>₹{{ $totalSales }}</h3>
                <p>Total Sales</p>
            </div>
            <div class="icon">
                <i class="fas fa-cash-register"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalStock }}</h3>
                <p>Total Stock Boxes</p>
            </div>
            <div class="icon">
                <i class="fas fa-warehouse"></i>
            </div>
        </div>
    </div>
</div>
@endsection
