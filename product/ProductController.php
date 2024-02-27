<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // tampilan table data produk
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('owner.dataproduk.produk',compact('products'))->with('i',(request()->input('page',1) - 1) * 5);
    }

    // tampilan form tambah data
    public function create()
    {
        return view('owner.dataproduk.create');
    }

    // fungsi menambah data
    public function database(Request $request)
    {
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
        }

        Product::create($input);

        return redirect()->route('security.produk')->with('success'.'product created successfully');
    }

    // tampilan form ubdah data
    public function edit(Request $request,$id){
        $products = Product::find($id);
        return view('owner.dataproduk.edit', compact('products'));
    }

    // fungsi ubah data
    public function update(Request $request, $id)
    {
        $products = Product::find($id);
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
        $products->update($input);
        return redirect()->route('security.produk')->with('success'.'product edit successfully');
    }

    // fungsi hapus data
    public function delete($id)
    {
        $products = Product::find($id);

        if($products){
            $products->delete();
        }

        return redirect()->route('security.produk');
    }

    // tampilan cart
    public function cart(){
        return view('admin.cart');
    }

    // fungsi tambah
    public function addToCart($id){
        $products = Product::findOrFail($id);

        $cart = session()->get('cart',[]);

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        } else{
            $cart[$id] = [
                "name" => $products->name,
                "price" => $products->price,
                "category_list" => $products->category_list,
                "image" => $products->image,
                "quantity" => 1
            ];
        }

        session()->put('cart',$cart);
        return redirect()->back()->with('success','berhasil menambahkan produk ke keranjang');
    }

    // fungsi hapus
    public function remove(Request $request){
            if($request->id){
                $cart = session()->get('cart');
                if(isset($cart[$request->id])){
                    unset($cart[$request->id]);
                    session()->put('cart',$cart);
                }
                session()->flash('success','produk berhasil di hapus');
            }
    }

    // fungsi update cart
    public function updated(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request-> id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }
}
