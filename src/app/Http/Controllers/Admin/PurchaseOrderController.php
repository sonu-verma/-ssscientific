<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\PurchaseOrder;
use App\Models\Admin\PurchaseOrderProduct;
use App\Models\Admin\Quote;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

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

    public function getPurchseOrder(Request $request){
        $searchTerm = trim($request->get('term', ''));
        $page = trim($request->get('page', 1));
        $limit = 10;
        if ($page < 1) {
            $page = 1;
        }

        $currentPage = $page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        $userType = [];
        $tblPO = PurchaseOrder::getTableName();
        $source = PurchaseOrder::where([$tblPO.'.status' => 1]);


        if ($searchTerm !== '' && strlen($searchTerm) > 0) {
            $source->where(function ($query) use ($searchTerm,$tblPO) {
                if (preg_match('/^[0-9]+$/', $searchTerm)) {
                    $query->where($tblPO.'.id', '=', $searchTerm);
                } else {
                    $query->where($tblPO.'.po_no', 'LIKE', '%'.$searchTerm.'%')
                        ->orWhere($tblPO.'.attn_no', 'LIKE', $searchTerm . '%');
                }
            });
        }
        $source->orderBy($tblPO.'.id', 'ASC')
            ->groupBy($tblPO.'.id');
        $result = $source->paginate($limit, [$tblPO.'.id',$tblPO.'.po_no']);

        return response()->json($result);
    }

}
