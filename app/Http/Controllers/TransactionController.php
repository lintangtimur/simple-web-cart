<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private TransactionService $transactionService;
    private CartService $cartService;

    public function __construct(CartService $cartService, TransactionService $transactionService)
    {
        $this->cartService = $cartService;
        $this->transactionService = $transactionService;    
    }

    public function confirm(Request $request)
    {
        //Kosongkan cart untuk user tersebut
        $this->cartService->deleteCart(auth()->user());
        $this->transactionService->addTx($request);

        return redirect()->route('history');
        
        
    }
}
