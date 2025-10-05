@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Transaction for {{ $product->name }}</h2>
    @foreach($errors->all() as $error)
          <ul class = "alert alert-danger">
              {{$error}}  
            </ul>
    @endforeach
     <div class="text-end mb-2">
            <a href="{{ route('products.index') }}" class="btn btn-primary mb-2">Back</a>
    </div>

    <form method="POST" action="{{ route('transactions.store', $product) }}">
        @csrf
        <select name="type" class="form-control mb-2">
            <option value="stock_in">Stock In (Purchase)</option>
            <option value="stock_out">Stock Out (Sale)</option>
        </select>
        <input type="number" name="quantity" placeholder="Quantity" class="form-control mb-2">
        <input type="text" name="note" placeholder="Note (optional)" class="form-control mb-2">
        <button class="btn btn-success">Save Transaction</button>
    </form>
</div>
@endsection
