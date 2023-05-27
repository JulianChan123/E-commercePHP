<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller{
    public function add(Request $request){
        
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'category'=>'required',
            'brand'=>'required',
            'desc'=>'required',
            'image'=>'required|image',
            'price'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 409);
        }

        $product = new product();
        $product->name = $request->name;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->save();
        
        $url="http://localhost:8000/storage/";
        $file=$request->file('image');
        $extension=$file->getClientOriginalExtension();
        $path=$request->file('image')->storeAs('proimages',$product->id.".".$extension);
        $product->image=$path;
        $product->imgPath=$url.$path;
        $product->save();



        
    }
    public function update(Request $request){
        
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'category'=>'required',
            'brand'=>'required',
            'desc'=>'required',
            'id'=>'required',
            'price'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 409);
        }

        $product = product::find($request->id);
        $product->name = $request->name;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->save();
        return response()->json(['message'=>"Product succesfully Updated"]);
        
    }
    public function delete(Request $request){
        
        $validator=Validator::make($request->all(),[
            'id'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 409);
        }

        $product = product::find($request->id)->delete();
   
        return response()->json(['message'=>"Product succesfully Deleted"]);
        
    }

    public function get(Request $request){
        session(['keys'=>$request->keys]);
        $products=product::where(function ($query){
            $query->where('products.id','LIKE','%'.session('keys').'%')
            ->orwhere('products.name','LIKE','%'.session('keys').'%')
            ->orwhere('products.price','LIKE','%'.session('keys').'%')
            ->orwhere('products.category','LIKE','%'.session('keys').'%')
            ->orwhere('products.brand','LIKE','%'.session('keys').'%');

        })->select('products.*')->get();
        return response()->json(['products'=>$products]);
    }
}
