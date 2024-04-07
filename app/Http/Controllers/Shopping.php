<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Shopping extends Controller
{
    public function ShowListItem(Request $request)
    {

        $data = DB::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->get();

        $tax = 0.15;
        $discount = 10;

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
        $discount = 10;

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
        $discount = 10;

        $data->tax = $tax;
        $data->discount = $discount;
        $data->total = ($data->price * $tax) + $data->price;
        $data->net = $data->total - $data->discount;


        $row = [
            'price' => $data->price,
            'qty' => $data->qty,
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
}
