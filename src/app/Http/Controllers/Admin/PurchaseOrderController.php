<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\PurchaseOrder;
use App\Models\Admin\PurchaseOrderProduct;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(){
        $purchaseOrder = PurchaseOrder::with('vendor')->get()->all();
        return view('admin.purchase_order.index',[
            'purchaseOrders' => $purchaseOrder
        ]);
    }

    public function create(){
        return view('admin.purchase_order.create');
    }

    public function store(Request $request){
//        dd($request->all());
        $request->validate([
            'vendor' => 'required',
            'attn_no' => 'required',
            'status' => 'required',
            'product' => 'required',
        ]);

        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->po_no = PurchaseOrder::purchaseOrderNumber();
        $purchaseOrder->vendor_id = $request->get('vendor');
        $purchaseOrder->attn_no = $request->get('attn_no');
        $purchaseOrder->status = $request->get('status');
        $purchaseOrder->save();

        if($purchaseOrder->id > 0){
            $products = $request->get('product');
            foreach($products as $product){
                $poProduct = new PurchaseOrderProduct();
                $poProduct->purchase_order_id = $purchaseOrder->id;
                $poProduct->id_product = $product;
                $poProduct->save();
            }
        }
        return redirect()->route('purchase.orders')->with("poSuccessMsg",'Purchase Order created successfully');
    }

    public function edit($purchaseOrderId){
        $purchaseOrder = PurchaseOrder::where('id',$purchaseOrderId)->with('vendor')->with('products')->get()->first();
        if($purchaseOrder){
            return view('admin.purchase_order.edit',[
                'model' => $purchaseOrder
            ]);
        }
    }

    public function update(Request $request,PurchaseOrder $purchaseOrder){
        $request->validate([
            'vendor' => 'required',
            'attn_no' => 'required',
            'status' => 'required',
            'product' => 'required',
        ]);

        if($purchaseOrder){
            $purchaseOrder->vendor_id = $request->get('vendor');
            $purchaseOrder->attn_no = $request->get('attn_no');
            $purchaseOrder->status = $request->get('status');
            $purchaseOrder->save();
            if($purchaseOrder->id > 0){
                PurchaseOrderProduct::where('purchase_order_id',$purchaseOrder->id)->delete();
                $products = $request->get('product');
                foreach($products as $product){
                    $poProduct = new PurchaseOrderProduct();
                    $poProduct->purchase_order_id = $purchaseOrder->id;
                    $poProduct->id_product = $product;
                    $poProduct->save();
                }
            }

            return redirect()->back()->with("poSuccessMsg",'Purchase Order updated successfully');
        }
    }

    public function destroy(PurchaseOrder $purchaseOrder){
        if($purchaseOrder){
            $id = $purchaseOrder->id;
            if($purchaseOrder->delete()){
                PurchaseOrderProduct::where('purchase_order_id',$id)->delete();
            }
            return redirect()->route('purchase.orders')->with("poSuccessMsg",'Purchase Order deleted successfully');
        }
        return redirect()->route('purchase.orders')->with("poErrorMsg",'Purchase Order not found');
    }

}
