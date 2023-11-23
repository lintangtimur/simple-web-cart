<?php

namespace App\Http\Controllers;

use App\Services\CartService;

class SummaryController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $summaries = $this->cartService->getSummaries(auth()->user());
        $carts = auth()->user()->cartItems()->get();
        

        return view('summary.index', compact('summaries', 'carts'));
    }
}
