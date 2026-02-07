@extends('adminlte::page')

@section('title', 'Add Sale')

@section('content_header')
<h1>Add Sale / Billing</h1>
@endsection

@section('content')

<form action="{{ route('sales.store') }}" method="POST" id="sale-form">
    @csrf

    <div class="row mb-3">
        <div class="col-md-6">
            <label>Customer (Optional)</label>
            <select name="customer_id" class="form-control">
                <option value="">Walk-in Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">
                        {{ $customer->name }} ({{ $customer->phone ?? 'No Phone' }})
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="sale-items-container">
        <div class="sale-item row mb-2">
            <div class="col-md-4">
                <select name="products[0][product_id]" class="form-control">
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->brand->name }} - {{ $product->size }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <input type="number" name="products[0][boxes]" class="form-control qty" placeholder="Boxes" min="1">
            </div>

            <div class="col-md-2">
                <input type="number" step="0.01" name="products[0][rate]" class="form-control rate" placeholder="Rate">
            </div>

            <div class="col-md-2">
                <input type="text" class="form-control total" placeholder="Total" readonly>
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-item">Remove</button>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-secondary mb-3" id="add-item">+ Add Another Product</button>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <label>Sub Total</label>
            <input type="text" id="sub_total" name="sub_total" class="form-control" readonly>
        </div>

        <div class="col-md-4">
            <label>Discount in Rupee</label>
            <input type="number" step="0.01" id="discount" name="discount" class="form-control" value="0">
        </div>

        <div class="col-md-4">
            <label>Grand Total</label>
            <input type="text" id="grand_total" name="grand_total" class="form-control font-weight-bold" readonly>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <label>Payment Amount</label>
            <input type="number" step="0.01" name="payment_amount" class="form-control">
        </div>

        <div class="col-md-6">
            <label>Payment Method</label>
            <select name="payment_method" class="form-control">
                <option value="">Select Method</option>
                <option value="Cash">Cash</option>
                <option value="UPI">UPI</option>
                <option value="Card">Card</option>
            </select>
        </div>
    </div>

    <br>

    <button type="submit" class="btn btn-success btn-lg">Save Sale</button>
</form>

@endsection

@section('js')
<script>
let index = 1;

// Add new row
document.getElementById('add-item').addEventListener('click', function() {
    let container = document.getElementById('sale-items-container');
    let div = document.createElement('div');
    div.classList.add('sale-item', 'row', 'mb-2');

    div.innerHTML = `
        <div class="col-md-4">
            <select name="products[${index}][product_id]" class="form-control">
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->brand->name }} - {{ $product->size }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <input type="number" name="products[${index}][boxes]" class="form-control qty" placeholder="Boxes" min="1">
        </div>

        <div class="col-md-2">
            <input type="number" step="0.01" name="products[${index}][rate]" class="form-control rate" placeholder="Rate">
        </div>

        <div class="col-md-2">
            <input type="text" class="form-control total" placeholder="Total" readonly>
        </div>

        <div class="col-md-2">
            <button type="button" class="btn btn-danger remove-item">Remove</button>
        </div>
    `;

    container.appendChild(div);
    index++;
});

// Remove row
document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-item')){
        e.target.closest('.sale-item').remove();
        calculateTotals();
    }
});

// Live calculation
document.addEventListener('input', function(e){
    if(e.target.classList.contains('qty') || e.target.classList.contains('rate') || e.target.id === 'discount'){
        calculateTotals();
    }
});

function calculateTotals() {
    let subTotal = 0;

    document.querySelectorAll('.sale-item').forEach(row => {
        let qty = parseFloat(row.querySelector('.qty')?.value) || 0;
        let rate = parseFloat(row.querySelector('.rate')?.value) || 0;
        let total = qty * rate;

        row.querySelector('.total').value = total.toFixed(2);
        subTotal += total;
    });

    let discount = parseFloat(document.getElementById('discount').value) || 0;
    let grandTotal = subTotal - discount;

    document.getElementById('sub_total').value = subTotal.toFixed(2);
    document.getElementById('grand_total').value = grandTotal.toFixed(2);
}
</script>
@endsection
