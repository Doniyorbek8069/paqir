<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $data = Product::query()->get();

        return view('product.index',compact('data'));
    }

   
    public function store(Request $request){
        Product::query()->create([
            'name'  => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->back();
    }
    public function update(Product $product,Request $request){
        Product::query()->where('id','=',$product->id)->update([
            'name'  => $request->name,
            'price' => $request->price,
        ]);
        
        return redirect()->back();
    }
}
