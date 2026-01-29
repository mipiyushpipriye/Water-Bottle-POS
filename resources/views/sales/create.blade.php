@extends('adminlte::page')

@section('title', 'Add Sale')

@section('content_header')
<h1>Add Sale / Billing</h1>
@endsection

@section('content')

<form action="{{ route('sales.store') }}" method="POST">
    @csrf

    <div id="sale-items-container">
        <div class="sale-item row mb-2">
            <div class="col-md-4">
                <select name="products[0][product_id]" class="form-control product-select">
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->brand->name }} - {{ $product->size }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="products[0][boxes]" class="form-control" placeholder="Boxes" min="1">
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" name="products[0][rate]" class="form-control" placeholder="Rate per box">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-item">Remove</button>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-secondary mb-2" id="add-item">Add Another Product</button>

    <div class="form-group">
        <label>Discount (Optional)</label>
        <input type="number" step="0.01" name="discount" class="form-control">
    </div>

    <div class="form-group">
        <label>Payment Amount (Optional)</label>
        <input type="number" step="0.01" name="payment_amount" class="form-control">
    </div>

    <div class="form-group">
        <label>Payment Method</label>
        <select name="payment_method" class="form-control">
            <option value="">Select Method</option>
            <option value="Cash">Cash</option>
            <option value="UPI">UPI</option>
            <option value="Card">Card</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Save Sale</button>
</form>

@endsection

@section('js')
<script>
let index = 1;

document.getElementById('add-item').addEventListener('click', function() {
    let container = document.getElementById('sale-items-container');
    let div = document.createElement('div');
    div.classList.add('sale-item', 'row', 'mb-2');
    div.innerHTML = `
        <div class="col-md-4">
            <select name="products[${index}][product_id]" class="form-control product-select">
                <option value="">Select Product</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->brand->name }} - {{ $product->size }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="products[${index}][boxes]" class="form-control" placeholder="Boxes" min="1">
        </div>
        <div class="col-md-2">
            <input type="number" step="0.01" name="products[${index}][rate]" class="form-control" placeholder="Rate per box">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger remove-item">Remove</button>
        </div>
    `;
    container.appendChild(div);
    index++;
});

document.addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('remove-item')){
        e.target.closest('.sale-item').remove();
    }
});
</script>
@endsection
