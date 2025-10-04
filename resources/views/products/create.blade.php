@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Product</h2>
     <div class="text-end mb-2">
        <a href="{{ route('products.index') }}" class="btn btn-primary mb-2">Back</a>
    </div>
    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Product Name" class="form-control mb-2">
        <input type="text" name="sku" placeholder="SKU" class="form-control mb-2">
        <input type="number" name="quantity" placeholder="Quantity" class="form-control mb-2">
        <input type="text" name="price" placeholder="Price" class="form-control mb-2">
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
