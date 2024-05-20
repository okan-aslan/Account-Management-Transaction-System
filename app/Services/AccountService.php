<?php

namespace App\Services;

use App\Repositories\AccountRepository;
use Illuminate\Support\Facades\Auth;

class AccountService
{
    protected $accountRepository;

    /**
     * Create a new instance of AccountService.
     *
     * @param AccountRepository $accountRepository An instance of the account repository.
     * @return void
     */
    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * Make a new account for the authenticated user.
     *
     * @param string $title The title or name of the account to be created.
     * @return mixed Returns the result of the account creation process.
     */
    public function makeAccount($request): mixed
    {
        if (!auth()->check()) {
            return redirect()->route('register');
        }

        $userId = auth()->user()->id;
        $accountNo = $this->generateAccountNo();
        $title = $request->input('title');

        return $this->accountRepository->createAccount($userId, $accountNo, $title);
    }

    /**
     * Generate a unique account number.
     *
     * @return int Returns a unique account number.
     */
    public function generateAccountNo(): int
    {
        do {
            $accountNo = mt_rand(10000000, 99999999);
        } while ($this->accountRepository->findByAccountNo($accountNo));

        return $accountNo;
    }
}
