@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Inventory</h2>

    {{--  Global Low Stock Alert --}}
    @if($products->where('quantity', '<=', 5)->count() > 0)
        <div class="alert alert-danger">
             Some products are running low on stock. Please restock soon!
        </div>
    @endif
    @can('create inventory')

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-2">Add Product</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    @endcan
    {{-- logout button --}}
    <form action="{{route('auth.logout')}}" method='POST'>
        @csrf
        <div class="text-end mb-2">
            <button type="submit" class="btn btn-danger">Logout</button>
        </div>
    </form>
    {{-- end logout button --}}

    
    {{-- search button --}}
    <form action="{{ route('products.index') }}" method="GET">
        <input type="text" name="search"  placeholder="Search products..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary mb-2">Search</button>
    </form>
    {{-- end search --}}
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
            <th>Transactions</th>
        </tr>
        @foreach($products as $p)
        <tr>
             
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->sku }}</td>
            <td>
                {{ $p->quantity }}
                @if($p->quantity <= 5)
                    <span style="background-color:#fff3cd;" class="badge bg-danger">Low Stock</span>
                @endif

            </td>
            <td>{{ $p->price }}</td>
            <td>
                @can('edit inventory')
                <a href="{{ route('products.edit', $p) }}" class="btn btn-warning btn-sm">Edit</a>
                @endcan
                @can('delete inventory')
                <form action="{{ route('products.destroy', $p) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete the product?')">Delete</button>
                </form>
                @endcan
            </td>
            <td>
                <a href="{{ route('transactions.history', $p) }}" class="btn btn-info btn-sm">History</a>
               @can('create inventory')
                <a href="{{ route('transactions.create', $p) }}" class="btn btn-secondary btn-sm">Add Transaction</a>
                @endcan
            </td>

        </tr>
        
        @endforeach
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
