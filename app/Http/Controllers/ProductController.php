<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('authMiddleware');
        $this->middleware('permission:view inventory')->only(['index']);
        $this->middleware('permission:create inventory')->only(['create', 'store']);
        $this->middleware('permission:edit inventory')->only(['edit', 'update']);
        $this->middleware('permission:delete inventory')->only(['destroy']);
    }

    public function index(Request $request)
    {
        // $products = Product::all();
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%");
        }

        $products = $query->paginate(5);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',

        ]);
        $validated["user_id"] = Auth::user()->id;
        Product::create($validated);
        return redirect()->route('products.index')->with('success','Product Created Successfully');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success','Product Updated Successfully');;
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Product Deleted Successfully');;
    }
}
