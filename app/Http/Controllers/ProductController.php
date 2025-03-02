<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.manageProduct')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('parent_id', null)->get();
        return view('admin.insertProduct')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:225',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category_id' => 'required',
            'featured_image' => 'required|image|mimes:jpeg,png,gif,svg|max:2048',
            'discount' => 'nullable|numeric',
            'sku' => 'required',
            'brand' => 'required',

        ]);

        $image = $request->file('featured_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('image'), $imageName);

        $data['slug'] = str::slug($data['name']);
        $data['featured_image'] = $imageName;

        Product::create($data);
        return redirect()->route('products.index')->with('success', "product created successfully");
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
