<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'desc' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 409);
        }

        $product = new product();
        $product->name = $request->name;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->save();

        return response()->json(['message' => "Product successfully added"]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'desc' => 'required',
            'id' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 409);
        }

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->save();
        
        return response()->json(['message' => "Product successfully updated"]);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 409);
        }

        $product = Product::find($request->id);
        $product->delete();

        return response()->json(['message' => "Product successfully deleted"]);
    }

    public function get(Request $request)
    {
        session(['keys' => $request->keys]);
        
        $products = Product::where(function ($query) {
            $keys = session('keys');
            $query->where('id', 'LIKE', '%' . $keys . '%')
                ->orWhere('name', 'LIKE', '%' . $keys . '%')
                ->orWhere('price', 'LIKE', '%' . $keys . '%')
                ->orWhere('category', 'LIKE', '%' . $keys . '%')
                ->orWhere('brand', 'LIKE', '%' . $keys . '%');
        })->get();

        return response()->json(['products' => $products]);
    }
}
