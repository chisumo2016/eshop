<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();

        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $product =  Product::create([
            'title' => request('title'),
            'price' => request('price'),
            'quantity' => request('quantity'),
            'description' => request('description'),
            'category_id' => request('category_id'),
            'brand_id' => request('brand_id'),
        ]);

       /**Check if products has images upload*/
        if ($request->hasFile('product_images')) {
            $productImages = $request->file('product_images');
            foreach ($productImages as $productImage) {
                /**Generate a unique name for the image using timestamp and random string*/
                $uniqueName = time() . '_' .Str::random(10) . '.' . $productImage->getClientOriginalName();
                /**Store the image in the public folder with unique name*/
                $productImage->move('product_images', $uniqueName);
                //$productImage->move(public_path('storage/product_images'), $uniqueName);
                /**Create a new product  image record with the product_id abd unique name*/
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'product_images/' .$uniqueName
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

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
