<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.products.index',[
            'products' => $products
        ]);
    }

    public function getProduct(Request $request){
        $productId = $request->get('id');
        $product = Product::where('id',$productId)->get()->first();
        return view('admin.products.product',[
            'product' => $product
        ]);
    }

    public function getProducts(Request $request){
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
        $tblProducts = Product::getTableName();
        $source = Product::where($tblProducts.'.status', '=', 1);

        if ($searchTerm !== '' && strlen($searchTerm) > 0) {
            $source->where(function ($query) use ($searchTerm,$tblProducts) {
                    $query->where($tblProducts.'.name', 'LIKE', $searchTerm.'%')
                        ->orWhere($tblProducts.'.description', 'LIKE', $searchTerm . '%')
                        ->orWhere($tblProducts.'.features', 'LIKE', $searchTerm . '%')
                        ->orWhere($tblProducts.'.short_description', 'LIKE', $searchTerm . '%');
            });
        }
        $source->orderBy($tblProducts.'.name', 'ASC')
            ->groupBy($tblProducts.'.id');

        $result = $source->paginate($limit, [$tblProducts.'.id',$tblProducts.'.name']);

        return response()->json($result);
    }

    public function addCartItem(Request $request){
        dd($request->all());
    }


    public function deleteProduct(Product $product){
        if($product){
            $product->delete();
            return redirect()->back()->with('productSuccessMsg',"Product deleted successfully.");
        }else{
            return redirect()->back()->with('productErrorMsg',"Product not found.");
        }
    }

    public function create(Request $request){
        $categories =  Category::where('status', 1)->get()->all();
        return view('admin.products.create',[
            'categories' => $categories
        ]);
    }

    public function store(Request $request){
        dd($request->all());
    }

    public function editProduct(Request $request){

    }
}
