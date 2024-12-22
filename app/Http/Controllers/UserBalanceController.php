<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\UserBalance;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBalanceController extends Controller
{
    /**
     * Display a listing of transactions for the logged-in user.
     */
    public function index()
{
    $this->authorize('view transactions');

    $userId = Auth::id();
    $transactions = Transaction::whereHas('userBalance', function ($query) use ($userId) {
        $query->where('user_id', $userId);
    })->latest()->paginate(10);

    return view('user.transactions.index', compact('transactions'));
}


    /**
     * Add balance to a user.
     */
    public function add(Request $request, $id)
    {
        $userBalance = UserBalance::findOrFail($id);

        // Ensure the balance belongs to the logged-in user
        if ($userBalance->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $amount = $request->input('amount');

        // Add the balance and create a transaction
        $userBalance->amount += $amount;
        $userBalance->save();

        Transaction::create([
            'user_balance_id' => $userBalance->id,
            'type' => 'Add',
            'amount' => $amount,
        ]);

        return back()->with('success', 'Balance added successfully.');
    }

    /**
     * Deduct balance from a user.
     */
    public function reduce(Request $request, $id)
    {
        $userBalance = UserBalance::findOrFail($id);

        // Ensure the balance belongs to the logged-in user
        if ($userBalance->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $amount = $request->input('amount');

        // Check if the user has enough balance
        if ($userBalance->amount < $amount) {
            return back()->with('error', 'Insufficient balance.');
        }

        // Deduct the balance and create a transaction
        $userBalance->amount -= $amount;
        $userBalance->save();

        Transaction::create([
            'user_balance_id' => $userBalance->id,
            'type' => 'Deduct',
            'amount' => $amount,
        ]);

        return back()->with('success', 'Balance reduced successfully.');
    }
}
