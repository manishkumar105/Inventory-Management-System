@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>
    @foreach($errors->all() as $error)
          <ul class = "alert alert-danger">
              {{$error}}  
            </ul>
    @endforeach
     <div class="text-end mb-2">
        <a href="{{ route('products.index') }}" class="btn btn-primary mb-2">Back</a>
    </div>
    <form method="POST" action="{{ route('products.update', $product) }}">
        @csrf @method('PUT')
        <input type="text" name="name" value="{{ $product->name }}" class="form-control mb-2">
        <input type="text" name="sku" value="{{ $product->sku }}" class="form-control mb-2">
        <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control mb-2">
        <input type="text" name="price" value="{{ $product->price }}" class="form-control mb-2">
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
