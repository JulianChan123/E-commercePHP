<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
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

}
