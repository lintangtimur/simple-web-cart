<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function addTx(Request $request)
    {
        $data = $request->all();

        // Filter data berdasarkan kunci yang memenuhi pola "product_*"
        $filteredData = collect($data)->filter(function ($value, $key) {
            return preg_match('/^product_\d+$/', $key);
        });

        // Ubah key yang memenuhi pola menjadi array asosiatif
        $result = $filteredData->mapWithKeys(function ($value, $key) {
            return [intval(str_replace('product_', '', $key)) => intval($value)];
        });
        
        DB::transaction(function () use ($request, $result) {
            $t = new Transaction();
            $t->user_id = auth()->user()->id;
            $t->total_amount = $request->total;
            $t->transaction_date = now();
            $t->save();

            $transactionId = $t->id;

            
            foreach ($result as $key => $value) {
                $td = new TransactionDetails();
                $td->transaction_id = $transactionId;
                $td->product_id = $key;
                $td->quantity = $value;
                $td->price = 0;
                $td->save();
            }
        });

    }

    public function getTx(User $user)
    {
        return $user->transactions()->get();
    }
}