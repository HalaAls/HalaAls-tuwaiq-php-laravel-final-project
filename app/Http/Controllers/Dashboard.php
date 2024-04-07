<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Dashboard extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function Logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
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

        $validatedData = $request->validate([
            'product_name' => 'required|string|max:25',
        ]);

        $product = Product::create([
            'product_name' => $request->Productname
        ]);
        $product->save();

        return redirect('/dashboard/products');
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



    // Products Details
    public function GetProductDetails()
    {

        $data = DB::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->select(
                'products.product_name',
                'product_details.id',
                'product_details.product_id',
                'product_details.color',
                'product_details.price',
                'product_details.qty',
                'product_details.description',
            )
            ->get();

        return view('dashboard.productDetails', ['data' => $data]);
    }


    public function createProductDetails(Request $request)
    {
        $validatedData = $request->validate([
            'color' => 'required|string|max:20',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'description' => 'required|string|max:255',
            'product_id' => Rule::exists('products', 'id'), // check that it exists in the 'products' table
        ]);

        $product = ProductDetails::create([
            'color' => $request->color,
            'price' => $request->price,
            'qty' => $request->qty,
            'description' => $request->description,
            'product_id' => $request->product_id
        ]);

        $product->save();

        // Redirect if validation passes
        return redirect('/dashboard/productdetails');
    }


    public function DeleteProductDetail($id)
    {
        $product = ProductDetails::find($id);
        $product->delete();

        return Redirect('/dashboard/productdetails');
    }

    public function UpdateProductDetail(Request $request)
    {
        $product = ProductDetails::where('id', $request->id)->update([
            'color' => $request->color,
            'price' => $request->price,
            'qty' => $request->qty,
            'description' => $request->description,
            'product_id' => $request->product_id
        ]);

        return Redirect('/dashboard/productdetails');
    }

    public function SearchProductDetail(Request $request)
    {
        $name = $request->product_name;

        $products = DB::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('products.product_name', 'like', "%$name%")
            ->get();

        return view('dashboard.productdetails', ['products' => $products]);
    }


    public function ShowProductDetail()
    {
        return Redirect('/dashboard/productdetails');
    }
}
