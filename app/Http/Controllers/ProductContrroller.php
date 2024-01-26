<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductContrroller extends Controller
{
    public function index(){
        $myProduct = Product::where('user_id', Auth::user()->id)->get();
        return view('my_product.index',compact('myProduct'));
    }
    public function create(){
        return view('product.create');
    }
    public function store(Request $request)
    {

        $attrs = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'file' => 'required|file',
        ]);
        $fileName = null; // Inisialisasi nama file menjadi null

        if ($request->hasFile('file')) {
            $fileName = time() . '.' . $request->file('file')->extension();
            $request->file('file')->move(public_path('products/'), $fileName);
        }
        
        $imageLink = asset('products/' . $fileName);
        // dd($imageLink);
        Product::create([
            'user_id' => Auth::user()->id,
            'name' => $attrs['name'],
            'description' => $attrs['description'],
            'price' => $attrs['price'],
            'image' => $imageLink,
        ]);
        
        return redirect()->route('myProduct.index');




    }
    public function edit($id)
    {

        $product = Product::find($id);

        if (!$product) {
            dd('gada product');
        }
        return view('product.edit',compact('product'));


    }
    public function update(Request $request,$id){

        $product = Product::find($id);
        if(!$product){
            dd('Gagal Menemukan product');
        }
        $attrs = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'file' => 'required|file',
        ]);

        $fileDocumentName = $product->image;
    
        if ($request->hasFile('file')) {
            $fileDocumentName = time() . '.' . $request->file('file')->extension();
            $request->file('file')->move(public_path('products/'), $fileDocumentName);
            
            if ($product->image && file_exists(public_path('products/' . $product->image))) {
                unlink(public_path('products/' . $product->image));
            }
        }
        $product->update([
            'name' => $attrs['name'],
            'description' => $attrs['description'],
            'price' => $attrs['price'],
            'image' => $fileDocumentName,
        ]);
        
        return redirect()->route('myProduct.index');
    
    }

    public function destroy($id)
    {

        $product = Product::find($id);

        if (!$product) {
            dd('gada product');
        }

        // Check if an old image exists and delete it
        if ($product->image) {
            $oldimage = public_path('products/' . $product->image);
            if (file_exists($oldimage)) {
                unlink($oldimage);
            }
        }

        $product->delete();

        return redirect()->route('myProduct.index');
    }
}
