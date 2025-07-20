<?php

namespace App\Http\Controllers;

use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    // public function index()
    // {

    //     return view('dashboard.wallet');
    // }

    public function show()
    {
        $user = Auth::user();
        $wallet = $user->wallet;
        $transactions = $user->walletTransactions()->latest()->get();

        return view('dashboard.wallet', compact('wallet', 'transactions'));
    }

    public function showFundForm()
    {
        return view('dashboard.fund-wallet');
    }

    public function processFund(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $user = Auth::user();

        $wallet = $user->wallet;
        $wallet->balance += $request->amount;
        $wallet->save();

        WalletTransaction::create([
            'user_id' => $user->id,
            'type' => 'fund',
            'amount' => $request->amount,
        ]);

        return redirect()->route('dashboard.wallet')->with('success', 'Wallet funded successfully.');
    }

    public function withdraw() {}
}
