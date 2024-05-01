<?php

namespace App\Http\Controllers;

use App\Models\AddItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function ProductStore(Request $request)
    {
        $productName = $request->get('product_name');
        $productPrice = $request->get('product_price');
        $productQty = $request->get('product_qty');
        
        for($i = 0; $i < count($productName); $i++){
            $qeury = new AddItem();
            $qeury->product = $productName[$i];
            $qeury->price = $productPrice[$i];
            $qeury->qty = $productQty[$i];
            $qeury->save();

            // Alternatively! Using query builder
            
            // $data = [
            //     'product' => $productName[$i],
            //     'price' => $productPrice[$i],
            //     'qty' => $productQty[$i],
            // ];
            
            // DB::table('add_items')->insert($data);
        }
        
        return response()->json(['message'=>'Product Added Successfully!']);
    } // End Method
}
