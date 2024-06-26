<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        
        if ($request->category !== null) {
            $stores = Store::where('category_id', $request->category)->sortable()->paginate(16);
            $total_count = Store::where('category_id', $request->category)->count();
            $category = Category::find($request->category);
        } elseif ($keyword !== null) {
            $stores = Store::where('name', 'like', "%{$keyword}%")->sortable()->paginate(16);
            $total_count = $stores->total();
            $category = null;
        } else {
            $stores = Store::sortable()->paginate(16);
            $total_count = "";
            $category = null;
        }
        

        $categories = Category::all();

        return view('stores.index', compact('stores', 'category', 'categories', 'total_count', 'keyword'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $reviews = $store->reviews()->get();

        return view('stores.show', compact('store', 'reviews'));
    }
}
