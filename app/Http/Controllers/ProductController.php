<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class ProductController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->productId;
        $quantity = $request->quantity;

        $this->cartService->addItemToCart($productId, $quantity);

        return response()->json([
            "message" => "sukses tambah ke cart"
        ], 200);
    }

    public function updateCart(Request $request)
    {
        $cartId = $request->cartId;
        $quantity = $request->quantity;

        $update = $this->cartService->updateQuantity($cartId, $quantity);

        return response()->json([
            "harga"=>Number::format($update['total']),
            'total'=>Number::format($update['summaries']['total']),
            'update'=> $update
        ]);
    }

    
}
