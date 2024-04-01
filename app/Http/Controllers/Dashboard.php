<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index()
    {
        return view('dashboard.index');
    }

    public function GetProducts()
    {
        $products = Product::all();

        return view('dashboard.products', ['products' => $products]);
    }


    public function CreateProduct(Request $request)
    {
        $product = Product::create([
            'product_name' => $request->Productname
        ]);
        $product->save();

        return Redirect('/dashboard/products');
    }

    public function DeleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return Redirect('/dashboard/products');
    }


    public function EditProduct($id)
    {
        $product = Product::find($id);

        return Redirect('/dashboard/products', ['products' => $product]);
    }

    public function UpdateProduct(Request $request)
    {
        $product = Product::where('id', $request->Productid)->update([
            'product_name' => $request->Productname
        ]);

        return Redirect('/dashboard/products');
    }

    public function SearchProducts(Request $request)
    {

        $productName = $request->Productname;
        $products = Product::where('product_name', 'like', "%$productName%")->get();
        // $products = Product::where('product_name', $request->Productname)->get();

        return view('dashboard.products', ['products' => $products]);
    }

    public function ShowProducts()
    {
        // $products = Product::all();
        return Redirect('/dashboard/products');
    }
}
