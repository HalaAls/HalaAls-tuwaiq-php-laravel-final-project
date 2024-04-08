<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class Shopping extends Controller
{
    public function ShowListItem(Request $request)
    {
        $data = DB::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->get();

        $tax = 0.15;
        $discount = 10 / 100;

        foreach ($data as $key => $value) {
            $data[$key]->total = $value->price * $tax + $value->price;
            $data[$key]->tax = $tax;
            $data[$key]->discount = $discount;
            $data[$key]->net = $data[$key]->total - $data[$key]->discount;
        }

        return view('shopping.listItems', ['data' => $data]);
    }
    public function GetListItemByCat(Request $request, $cat)
    {

        $data = DB::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('product_details.category', $cat)
            ->get();

        $tax = 0.15;
        $discount = 10 / 100;

        foreach ($data as $key => $row) {
            $data[$key]->tax = $tax;
            $data[$key]->discount = $discount;
            $data[$key]->total = ($data[$key]->price * $tax) + $data[$key]->price;
            $data[$key]->net = $data[$key]->total - $data[$key]->discount;
        }


        return view('shopping.listItems', ['data' => $data]);
    }


    public function ShowDetail($id)
    {
        $data = DB::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('product_details.id', '=', $id)
            ->first();

        $tax = 0.15;
        $discount = 10 / 100;

        $data->tax = $tax;
        $data->discount = $discount;
        $data->total = ($data->price * $tax) + $data->price;
        $data->net = $data->total - $data->discount;

        return view('shopping.details', ['data' => $data]);
    }

    public function AddToCart(Request $request, $id)
    {

        $user_id = $request->user()->id;

        $data = DB::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('product_details.id', '=', $id)
            ->first();

        $tax = 0.15;
        $discount = 10 / 100;


        $data->tax = $tax;
        $data->discount = $discount;
        $data->total = ($data->price * $tax) + $data->price;
        $data->net = $data->total - $data->discount;


        $row = [
            'price' => $data->price,
            'qty' => $request->qty,
            'tax' => $data->tax,
            'net' => $data->net,
            'total' => $data->total,
            'discount' => $data->discount,
            'product_id' => $data->id,
            'user_id'  => $user_id,
        ];

        DB::table('carts')->insert($row);

        $count = DB::table('carts')
            ->where('user_id', '=', $user_id)
            ->count();

        Session::put('count', $count);

        return redirect()->back();
    }

    public function ShowCart(Request $request)
    {
        $user_id = $request->user()->id;


        $cartItems = DB::table('carts')
            ->join('product_details', 'product_details.id', '=', 'carts.product_id')
            ->join('products', 'product_details.product_id', '=', 'products.id')
            ->select('carts.*', 'products.product_name', 'product_details.description', 'product_details.image')
            ->where('carts.user_id', $user_id)
            ->get();

        $subtotal = 0;
        $totalWithTax = 0;
        $totalWithDiscount = 0;

        // Calculate subtotal and total
        foreach ($cartItems as $item) {
            $subtotal += $item->price * $item->qty;
            $totalWithTax += $item->total * $item->qty;
            $totalWithDiscount += $item->net * $item->qty;
        };

        $summary = new \stdClass();
        $summary->subtotal = $subtotal;
        $summary->totalWithTax = $totalWithTax;
        $summary->totalWithDiscount = $totalWithDiscount;

        return view('shopping.cart', ['cartItems' => $cartItems, 'summary' => $summary]);
    }


    // public function downloadPDF(Request $request)
    // {
    //     $user_id = $request->user()->id;

    //     $cartItems = DB::table('carts')
    //         ->join('product_details', 'product_details.id', '=', 'carts.product_id')
    //         ->join('products', 'product_details.product_id', '=', 'products.id')
    //         ->select('product_details.file')
    //         ->where('carts.user_id', $user_id)
    //         ->get();
    // }



    // public function downloadPDF(Request $request)
    // {
    //     $user_id = $request->user()->id;

    //     // Retrieve PDF file paths from the database
    //     $cartItems = DB::table('carts')
    //         ->join('product_details', 'product_details.id', '=', 'carts.product_id')
    //         ->join('products', 'product_details.product_id', '=', 'products.id')
    //         ->select('product_details.file')
    //         ->where('carts.user_id', $user_id)
    //         ->get();

    //     // foreach ($cartItems as $cartItem) {
    //     //     $pdfPath = storage_path('app\\public\\assets\\file\\' . $cartItem->file);
    //     //     if (file_exists($pdfPath)) {
    //     //         $fileName = basename($cartItem->file);
    //     //         $headers = [
    //     //             'Content-Type' => 'application/pdf',
    //     //         ];
    //     //         // Download the PDF file
    //     //          response()->download(Storage::path('\\public\\assets\\file\\' . $cartItem->file), $fileName, $headers);
    //     //     }
    //     // }



    // }
    public function downloadPDF(Request $request)
    {
        $user_id = $request->user()->id;

        // Retrieve product details along with file names for the products in the cart
        $cartItems = DB::table('carts')
            ->join('product_details', 'product_details.id', '=', 'carts.product_id')
            ->select('product_details.file')
            ->where('carts.user_id', $user_id)
            ->get();

        // Check if the cart items exist
        if ($cartItems->isEmpty()) {
            return abort(404);
        }

        // Initialize an array to hold the file paths of the files to be zipped
        $filesToZip = [];

        // Loop through each cart item and add the corresponding file to the filesToZip array
        foreach ($cartItems as $cartItem) {
            $filePath = storage_path('app/public/assets/file/' . $cartItem->file);

            // Check if the file exists before adding it to the zip
            if (file_exists($filePath)) {
                $filesToZip[] = $filePath;
            }
        }

        // Check if any files were found
        if (empty($filesToZip)) {
            return abort(404);
        }

        // Create a zip archive
        $zipFileName = 'purchase_' . time() . '.zip';
        $zipPath = storage_path('app/' . $zipFileName);

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return "Failed to create the zip file.";
        }

        // Add files to the zip archive
        foreach ($filesToZip as $filePath) {
            $zip->addFile($filePath, basename($filePath));
        }

        // Close the zip archive
        $zip->close();

        // Download the zip file
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
