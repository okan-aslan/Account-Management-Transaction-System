<?php

namespace App\Http\Controllers;

use App\Models\AutomaticPayment;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AutomaticPaymentController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = Auth::user();

        $accounts = $user->accounts;

        return view('automatic-payment.automatic-payment-index', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->transactionService->handleAutomaticPayment($request);

        return redirect()->route('automatic-payments.index')->with('success', 'Automatic Payment is Active ...');
    }
}
