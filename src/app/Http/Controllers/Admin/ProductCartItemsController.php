<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductCartItems;
use Illuminate\Http\Request;

class ProductCartItemsController extends Controller
{
    public function addCartItem(Request $request){
        $quote_id = $request->get('quote_id');
        $product_id = $request->get('productId');
        $quantity = $request->get('quantity');
        $assetValue = $request->get('assetValue');
        $originalAssetValue = $request->get('originalAssetValue');
        $isProductAdded = ProductCartItems::where(['quote_id'=>$quote_id,'product_id' => $product_id])->get()->count();
        if($isProductAdded > 0){
            return response()->json([
                'message' => 'product already added.',
                'status' => false
            ]);
        }else{
            $cartItem = new ProductCartItems();
            $cartItem->quote_id = $quote_id;
            $cartItem->product_id = $product_id;
            $cartItem->quantity = $quantity;
            $cartItem->asset_value = $assetValue;
            $cartItem->original_asset_value = $originalAssetValue;
            $cartItem->save();
        }

        return response()->json([
            'message' => 'product added successfully.',
            'status' => true
        ]);
    }

    public function getItems(Request $request,$quote_id){
//        echo $quote_id;
//        dd($request->all());
//        $quote_id = $request->get('quote_id');
        $items = ProductCartItems::where('quote_id',$quote_id)->with('product')->get()->all();
        $html =  view('admin.quotes.items',[
            'items' => $items
        ])->render();

        return response()->json([
            'html' => $html,
            'status' => true
        ]);
    }
}
