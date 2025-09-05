<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //filter by category
    public function filterByCategory($id)
    {
        $search = request('search');
        $categories = Category::all();

        $products = Product::with('category')
            ->when($id !== 'all', function ($query) use ($id) {
                $query->where('category_id', $id);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->latest()
            ->simplePaginate(12);

        return view('products.all', compact('products', 'categories'))
            ->with('currentCategory', $id);
    }

    public function productDetails($id)
    {
        $products = Product::with('category')->findOrFail($id);

        $relatedProducts = Product::with('category')
            ->where('category_id', $products->category_id)
            ->where('id', '!=', $products->id) // biar produk yang diklik nggak ikut
            ->take(4)
            ->get();

        return view('products.productDetails', compact('products', 'relatedProducts'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->simplePaginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|max:2048',
            'price' => 'required|integer|min:1',
            'stok' => 'required|integer|min:0',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        //path image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        //create db
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stok' => $request->stok,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        //redirect to index
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //validate
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|max:2048',
            'price' => 'required|integer|min:1',
            'stok' => 'required|integer|min:0',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        //path image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        //create db
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stok' => $request->stok,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        //redirect to index
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
