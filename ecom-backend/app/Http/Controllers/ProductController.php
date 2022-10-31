<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

        public function addProduct(Request $req)
        {
           //return $req->file('file')->store('products');
          // return $req->input();
          $product = new Product;
          $product->name=$req->input('name');
          $product->price=$req->input('price');
          $product->description=$req->input('description');
          $product->file_path=$req->file('file')->store('products');
          $product->save();
          return $product;

        }

    public function list()
    {

        return Product::all();
    }

    public function delete($id)
    {
        $result = Product::where('id',$id)->delete();
        if($result)
        {
            return ["result"=>"Product has been deleted"];
        }else {

            return ["result"=>"Operation Failed"];
        }
    }
    public function getProduct($id)
    {
        return Product::find($id);
    }
    public function search($key)
    {
        return Product::where('name','Like',"%$key%")->get();
    }

}
