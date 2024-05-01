<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\WasteCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = WasteCategory::orderBy('name','ASC')->leftJoin('categories','categories.id','waste_categories.type')->select('waste_categories.*','categories.name as cat_name')->get();
        return view('products.all',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('type',2)->where('is_active',1)->get();
        return view('products.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
        ]);
        $user = new WasteCategory();
        $user->name = $request->name ?? null;
        $user->type = $request->type ?? null;
        $user->save();
        $notification = array(
            'message' => 'Waste product added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = WasteCategory::find($id);
        $categories = Category::where('type',2)->where('is_active',1)->get();
        return view('products.edit',compact('data','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
        ]);
        $category = WasteCategory::find($id);
        $category->name = $request->name ?? null;
        $category->type = $request->type ?? null;
        $category->is_active = $request->is_active ?? null;
        $category->save();
        $notification = array(
            'message' => 'Waste category updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
