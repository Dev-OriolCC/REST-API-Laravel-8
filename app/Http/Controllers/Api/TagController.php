<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    // * Consstruct Methods
    public function __construct() {
        $this->middleware('auth:api')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Tag::all()->count() > 1 ) {
            $tags = Tag::included()
                ->filter()
                ->sort()
                ->getOrPaginate();
            return TagResource::collection($tags);
        }
        return response()->json([
            'message' => 'No tags found'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:tags'
        ]);
        $tag = Tag::create($request->all());
        return TagResource::make($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $tag = Tag::included()->findOrFail($id);
        return TagResource::make($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag) {
        $request->validate([
            'name' => 'required|min:4'
        ]);
        $tag->update($request->all());
        return TagResource::make($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag) {
        $tag->delete();
        return TagResource::make($tag);
    }
}
