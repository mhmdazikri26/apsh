<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('owner.product.index', [
            'product' => Product::latest()->get(),
            'no' => 1,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => ['required'],
            'name' => ['required', 'min:3'],
            'category_list' => ['required'],
            'price' => ['required'],
            'image' => ['image'],
        ]);

        $img = null;

        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('photos');
        }

        $input = $request->all();

        if($image = $request->file('image')){
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') ."." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Product::create($input);
        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect()->route('security.product.index');
    
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
        $product = Product::find($id);
        return view('owner.product.edit', compact('product'));
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
        $product = Product::find($id);
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'category_list' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        

        $input = $request->all();

        if($image = $request->file('image')){
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') ."." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
        $product->update($input);

        session()->flash('success', 'Data Berhasil Diubah');
        return redirect()->route('security.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if($product){
            $product->delete();
        }

        session()->flash('success', 'Data Berhasil Dihapus');
        return redirect()->route('security.product.index');
    }
}
