<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

    public function GetProducts(Request $request)
    {
        if ($request->search) {
            $productName = $request->search;
            $products = Product::where('product_name', 'like', "%$productName%")->get();
        } else {
            $products = Product::all();
        }
        return view('dashboard.products', ['products' => $products]);
    }


    public function CreateProduct(Request $request)
    {

        $validatedData = $request->validate([
            'product_name' => 'required|string|max:25',
        ]);

        $product = Product::create([
            'product_name' => $request->product_name
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

        return view('dashboard.products', ['products' => $products]);
    }

    public function ShowProducts()
    {
        // $products = Product::all();
        return Redirect('/dashboard/products');
    }



    // Products Details
    public function GetProductDetails(Request $request)
    {
        $products = Product::all();

        if ($request->search) {
            $name = $request->search;
            $data = DB::table('products')
                ->join('product_details', 'products.id', '=', 'product_details.product_id')
                ->where('products.product_name', 'like', "%$name%")
                ->get();
        } else {

            $data = DB::table('products')
                ->join('product_details', 'products.id', '=', 'product_details.product_id')
                ->select(
                    'products.product_name',
                    'product_details.id',
                    'product_details.product_id',
                    'product_details.price',
                    'product_details.qty',
                    'product_details.description',
                    'product_details.category',
                    'product_details.image',
                    'product_details.file'
                )
                ->get();
        }
        return view('dashboard.productDetails', ['data' => $data, 'products' => $products]);
    }


    public function createProductDetails(Request $request)
    {
        $validatedData = $request->validate([
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'description' => 'required|string|max:255',
            'product_id' => Rule::exists('products', 'id'), // check that it exists in the 'products' table
            'category' => 'required | string',

        ]);

        if ($request->hasFile('file')) {

            $filenameWithExt = $request->file('file')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('file')->getClientOriginalExtension();

            $fileNameToStore = $filename . '-' . time() . '.' . $extension;

            $path = $request->file('file')->storeAs('public/assets/file', $fileNameToStore);
        } else {
            $fileNameToStore = 'default.png';
        }

        $imageName = '';
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('/assets/images'), $imageName);
        } else {
            $imageName = 'default.png';
        }


        $product = ProductDetails::create([
            'price' => $request->price,
            'qty' => $request->qty,
            'description' => $request->description,
            'product_id' => $request->product_id,
            'category' => $request->category,
            'image' =>  $imageName,
            'file' => $fileNameToStore

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
        // dd($request);

        if ($request->hasFile('file')) {

            $filenameWithExt = $request->file('file')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('file')->getClientOriginalExtension();

            $fileNameToStore = $filename . '-' . time() . '.' . $extension;

            $path = $request->file('file')->storeAs('public/assets/file', $fileNameToStore);
        } else {
            $existingProduct = ProductDetails::find($request->id);
            $fileNameToStore = $existingProduct->file; // use the existing pdf filename       
        }


        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('/assets/images'), $imageName);
        } else {
            $existingProduct = ProductDetails::find($request->id);
            $imageName = $existingProduct->image; // use the existing image filename
        }

        $product = ProductDetails::where('id', $request->id)->update([
            'price' => $request->price,
            'qty' => $request->qty,
            'description' => $request->description,
            'product_id' => $request->product_id,
            'category' => $request->category,
            'image' =>  $imageName,
            'file' => $fileNameToStore
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
