<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;


class ProductsController extends Controller
{
    public function index()
    {
        return view('pages.products.index');
    }

    public function show($id)
    {
        $data = Product::where('_id', $id)->first();

        return view('pages.products.view')->with([ 'data' => $data ]);
    }
    
    public function chart()
    {
        $data = Product::all();
        
        $dataPoints = array();

        foreach($data as $row) {
            array_push($dataPoints, array("label"=> $row->product_title, "y"=> $row->quantity));
        }

        $html = view('pages.products.chart')->with(['dataPoints' => $dataPoints])->render();

        return response()->json(['html' => $html]);
    }
}
