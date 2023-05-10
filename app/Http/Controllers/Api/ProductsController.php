<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Http\Requests\ProductsRequest;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {
        $data = Product::orderBy('id', 'DESC')->get();
        
        return response()->json($data);
    }

    public function update(ProductsRequest $request, $id)
    {
        $data = $request->validated();

        try {
            
            Product::find($id)->update($data);
            return response()->json(['success' => true]);

        } catch(QueryException $e) {
            return response()->json(['error' => $e->errorInfo[2]]);
        }
    }

    public function find(Request $request)
    {
        $keyword = $request->input('keyword');

        try {
            
            $result = Product::where('product_title','LIKE', "%{$keyword}%")
                    ->orWhere('sku', 'LIKE', "%{$keyword}%")
                    ->get();

            return response()->json($result);

        } catch(QueryException $e) {
            return response()->json(['error' => $e->errorInfo[2]]);
        }
    }
}
