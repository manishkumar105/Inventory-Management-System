<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class InventoryTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('authMiddleware');
        $this->middleware('permission:view inventory')->only(['index','history']);
        $this->middleware('permission:create inventory')->only(['create', 'store']);
        $this->middleware('permission:edit inventory')->only(['edit', 'update']);
        $this->middleware('permission:delete inventory')->only(['destroy']);
        
    }
    public function create(Product $product)
    {
        return view('transactions.create', compact('product'));
       
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'type' => 'required|in:stock_in,stock_out',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string'
        ]);

        // Prevent going below zero
        if ($request->type === 'stock_out' && $product->quantity < $request->quantity) {
            return back()->with('error', 'Not enough stock available!');
        }

        // Save transaction
        InventoryTransaction::create([
            'product_id' => $product->id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'note' => $request->note,
            'user_id'=> Auth::id(),
        ]);
        

        // Update product quantity
        if ($request->type === 'stock_in') {
            // $product->quantity = $product->quantity + $request->quantity;
            // $product->save();
            $product->increment('quantity', $request->quantity);
        } else {
            $product->decrement('quantity', $request->quantity);
        }

        return redirect()->route('products.index')->with('success', 'Transaction recorded successfully!');
    }

    public function history(Product $product)
    {
        $transactions = $product->transactions()->latest()->get();
        return view('transactions.history', compact('product', 'transactions'));
    }
}

