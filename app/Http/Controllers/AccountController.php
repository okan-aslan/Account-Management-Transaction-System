<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Services\AccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Account $account): View
    {
        $accounts = $account->all();
        
        return view('account.account-index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('account.account-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->accountService->makeAccount($request);

        return redirect()->route('accounts.index')->with('success', 'Account Created Successfully ...');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account): View
    {
        $transactions = $account->transactions()->orderBy('created_at', 'DESC')->paginate(7);
        
        return view('account.account-show', compact('account', 'transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        if($account->balance != 0)
        {
            return redirect()->back()->withErrors(['You need to empty your balance !']);
        }
        
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully ...');
    }
}
