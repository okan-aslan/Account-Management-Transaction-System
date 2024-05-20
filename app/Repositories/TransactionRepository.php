<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Transaction;

class TransactionRepository
{
    /**
     * Create a new transaction record.
     *
     * @param int $accountId The ID of the account associated with the transaction.
     * @param string $transactionType The type of transaction (income or expense).
     * @param float $amount The transaction amount.
     * @param string|null $description The description of the transaction (optional).
     * 
     * @return Transaction
     */
    public function makeTransaction(int $accountId, string $transactionType, float $amount, ?string $description = null): Transaction
    {        
        return Transaction::create([
            'account_id' => $accountId,
            'transaction_type' => $transactionType,
            'amount' => $amount,
            'description' => $description,
        ]);
    }

    /**
     * Check if the user has an account with the specified account number.
     *
     * @param mixed $user The user object.
     * @param string $accountNo The account number to search for.
     * 
     * @return Account|null
     */
    public function userHasAccount($user, $accountNo): Account|null
    {
        return $user->accounts()->where('account_no', $accountNo)->first();
    }
}
