<?php

namespace App\Repositories;

use App\Models\Account;

class AccountRepository
{
    /**
     * Create a new account.
     *
     * @param int $userId The ID of the user for whom the account is being created.
     * @param string $accountNo The account number for the new account.
     * @param string $title The title or name of the account.
     * @return void
     */
    public function createAccount($userId, string $accountNo, string $title)
    {
        return Account::create([
            'user_id' => $userId,
            'account_no' => $accountNo,
            'title' => $title,
        ]);
    }

    /**
     * Check if an account exists with the given account number.
     *
     * @param string $accountNo The account number to search for.
     * @return bool Returns true if an account with the given account number exists, otherwise false.
     */
    public function findByAccountNo($accountNo): bool
    {
        return Account::where('account_no', $accountNo)->exists();
    }
}
