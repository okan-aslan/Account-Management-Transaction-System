<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schedule;

class TransactionService
{
    protected TransactionRepository $transactionRepository;
    protected mixed $user;

    /**
     * TransactionService constructor.
     *
     * @param TransactionRepository $transactionRepository
     */
    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->user = Auth::user();
    }

    /**
     * Handle the transaction request.
     *
     * @param Request $request The request containing transaction data.
     * 
     * @return RedirectResponse
     */
    public function handleTransaction(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'account_no' => 'required|string|size:8|exists:accounts,account_no',
            'transaction_type' => 'required|string|in:income,expense',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255'
        ]);

        $transactionType = $validated['transaction_type'];
        $amount = $validated['amount'];
        $accountNo = $validated['account_no'];
        $description = $validated['description'] ?? null;

        return $this->processTransaction($accountNo, $amount, $transactionType, $description);
    }

    /**
     * Handle the automatic payment request.
     *
     * @param Request $request The request containing automatic payment data.
     * 
     * @return RedirectResponse
     */
    public function handleAutomaticPayment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'account_no' => 'required|string|size:8|exists:accounts,account_no',
            'frequency' => 'required|string|in:weekly,monthly',
            'amount' => 'required|numeric|min:0.01',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $accountNo = $validated['account_no'];
        $frequency = $validated['frequency'];
        $amount = $validated['amount'];
        $startDate = $validated['start_date'];
        $endDate = $validated['end_date'];

        return $this->processAutomaticTransaction($accountNo, $frequency, $amount, $startDate, $endDate);
    }

    /**
     * Find the user's account with the given account number.
     *
     * @param string $accountNo The account number.
     * 
     * @return mixed
     */
    protected function findUserAccount(string $accountNo): mixed
    {
        $account = $this->transactionRepository->userHasAccount($this->user, $accountNo);

        if (!$account) {
            abort(404, 'Account not found');
        }

        return $account;
    }

    /**
     * Process the transaction.
     *
     * @param string $accountNo The account number.
     * @param float $amount The transaction amount.
     * @param string $transactionType The type of transaction (income or expense).
     * @param string|null $description The transaction description.
     * 
     * @return RedirectResponse
     */
    protected function processTransaction(string $accountNo, float $amount, string $transactionType, ?string $description): RedirectResponse
    {
        $account = $this->findUserAccount($accountNo);

        if ($transactionType === 'income') {
            $this->increaseBalance($account, $amount);
        } else {
            if (!$this->decreaseBalance($account, $amount)) {
                return redirect()->back()->withErrors(['Insufficient balance']);
            }
        }

        $this->transactionRepository->makeTransaction($account->id, $transactionType, $amount, $description);

        return redirect()->route('transactions.index')->with('success', 'Transaction was successful!');
    }

    /**
     * Process the automatic transaction.
     *
     * @param string $accountNo The account number.
     * @param float $amount The transaction amount.
     * @param string $frequency The frequency of the automatic transaction.
     * @param mixed $startDate The start date of the automatic transaction.
     * @param mixed $endDate The end date of the automatic transaction.
     * 
     * @return RedirectResponse
     */
    protected function processAutomaticTransaction(string $accountNo, string $frequency, float $amount, $startDate, $endDate): RedirectResponse
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);


        while ($startDate->lessThanOrEqualTo($endDate)) {

            $this->processTransaction($accountNo, $amount, 'expense', 'Automatic Payment');

            if ($frequency === 'weekly') {
                $startDate->addWeek();
            } elseif ($frequency === 'monthly') {
                $startDate->addMonth();
            }
        }


        return redirect()->route('transactions.index')->with('success', 'Automatic payment was successful!');
    }



    /**
     * Increase the balance of the account.
     *
     * @param mixed $account The account object.
     * @param float $amount The amount to increase.
     * 
     * @return bool
     */
    protected function increaseBalance(mixed $account, float $amount): bool
    {
        $account->balance += $amount;
        return $account->save();
    }

    /**
     * Decrease the balance of the account.
     *
     * @param mixed $account The account object.
     * @param float $amount The amount to decrease.
     * 
     * @return bool
     */
    protected function decreaseBalance(mixed $account, float $amount): bool
    {
        if ($account->balance < $amount) {
            return false;
        }

        $account->balance -= $amount;
        return $account->save();
    }
}
