<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // * Construct method
    public function __construct() {
        $this->middleware('auth:api')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Brand::all()->count()) {
            $brands = Brand::included()
                ->filter()
                ->sort()
                ->getOrPaginate();
                return BrandResource::collection($brands);
        }
        return response()->json([ 'message' => 'No brands found.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:4|unique:brands',
            'email' => 'required|email|unique:brands',
            'website' => 'required|unique:brands'
        ]);
        $brand = Brand::create($request->all());
        return BrandResource::make($brand);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $brand = Brand::included()->findOrFail($id);
        return BrandResource::make($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand) {
        $request->validate([
            'name' => 'required|min:4|unique:brands',
            'email' => 'required|email',
            'website' => 'required'
        ]);
        $brand->update($request->all());
        return BrandResource::make($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand) {
        $brand->delete();
        return BrandResource::make($brand);
    }
}
