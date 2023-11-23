<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\TransactionService;

class HistoryController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $tx = $this->transactionService->getTx(auth()->user());

        return view("history.index", compact('tx'));
    }
}
