<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction; // Import the Transaction model
use Illuminate\Support\Str;

class AssignTransactionIds extends Command
{
    protected $signature = 'transactions:assign-ids';
    protected $description = 'Assign UUIDs to existing transactions without a transaction ID';

    public function handle()
    {
        $transactions = Transaction::whereNull('transaction_id')->get();

        foreach ($transactions as $transaction) {
            $transaction->transaction_id = (string) Str::uuid();
            $transaction->save();
        }

        $this->info('Transaction IDs assigned successfully.');
    }
}
