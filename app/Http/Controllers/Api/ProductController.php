<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // * Construct Method
    public function __construct() {
        $this->middleware('auth:api')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Product::included()
            ->filter()
            ->sort()
            ->getOrPaginate();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:4|unique:products',
            'description' => 'required|min:6',
            'price' => 'required',
            'color' => 'required',
            'category_id' => 'required|exits:categories,id',
            'brand_id' => 'required|exits:brands,id'
        ]);
        $product = Product::create($request->all());
        return ProductResource::make($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $product = Product::included()->findOrFail($id);
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'required|min:4|unique:products',
            'description' => 'required|min:6',
            'price' => 'required',
            'color' => 'required',
            'category_id' => 'required|exits:categories,id',
            'brand_id' => 'required|exits:brands,id'
        ]);
        $product->update($request->all());
        return ProductResource::make($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product) {
        $product->delete();
        return ProductResource::make($product);
    }
}
