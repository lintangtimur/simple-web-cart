<?php

namespace App\Http\Controllers;

use App\Services\CartService;

class HistoryController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $history = $this->cartService->getHistoryBuy(auth()->user());
        $totalPurchase = $this->cartService->getSummaries(auth()->user())['total'];
        

        return view("history.index", compact('history', 'totalPurchase'));
    }
}
