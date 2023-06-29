<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('home',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
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
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        $product = Product::create($request->all());

        // Upload any new photo updated in edit mode
        if(file_exists($_FILES['thumbnail']['tmp_name']))
        {
            $imageName = time().'.'.request()->thumbnail->getClientOriginalExtension();
            request()->thumbnail->move(public_path('images'), $imageName);  

            $prod_image                 = Product::find($product->id);
            $prod_image->thumbnail      = $imageName;  
            $prod_image->update();
        }

        return redirect()->route('admin.home')->with('success','Inserted Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'thumbnail' => 'image|mimes:jpeg,jpg,png',
        ]);

        $product = Product::find($id);
        $product->update($request->all());

        // Upload any new photo updated in edit mode
        if(file_exists($_FILES['thumbnail']['tmp_name']))
        {
            $imageName = time().'.'.request()->thumbnail->getClientOriginalExtension();
            request()->thumbnail->move(public_path('images'), $imageName);  

            $prod_image                 = Product::find($id);
            $prod_image->thumbnail      = $imageName;  
            $prod_image->update();
        }

        return redirect()->route('admin.home')->with('success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::destroy($id);
        return redirect()->route('admin.home')->with('danger','Deleted Successfully');
    }
}
