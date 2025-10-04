@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transaction History for {{ $product->name }}</h2>
    @can('create inventory')
    <a href="{{ route('transactions.create', $product) }}" class="btn btn-primary mb-2">Add Transaction</a>
    @endcan

    <div class="text-end mb-2">
            <a href="{{ route('products.index') }}" class="btn btn-primary mb-2">Back</a>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>ID</th><th>Type</th><th>Quantity</th><th>Note</th><th>Date</th>
        </tr>
        @foreach($transactions as $t)
        <tr>
            <td>{{ $t->id }}</td>
            <td>
                @if($t->type === 'stock_in')
                    <span class="badge bg-success">Stock In</span>
                @else
                    <span class="badge bg-danger">Stock Out</span>
                @endif
            </td>
            <td>{{ $t->quantity }}</td>
            <td>{{ $t->note }}</td>
            <td>{{ $t->created_at->format('d M Y H:i') }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
