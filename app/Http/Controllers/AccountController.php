<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private $user;
    private $account;

    public function __construct(User $user, Account $account)
    {
        $this->user = $user;
        $this->account = $account;
    }

    public function accountIndex()
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        $all_accounts = $this->account->get();

        return view('account.index')
            ->with('user', $user)
            ->with('all_accounts', $all_accounts);
    }

    public function accountCreate()
    {
        return view('account.create');
    }

    public function accountSave(Request $request)
    {
        $request->validate([
            'balance' => 'required'
        ]);

        $this->account->balance = $request->balance;
        $this->account->user_id = Auth::user()->id;

        $this->account->save();

        return redirect()->route('account.index');
    }

    public function accountDeposit()
    {
        $all_accounts = $this->account->get();

        return view('account.deposit')
            ->with('all_accounts', $all_accounts);
    }

    public function accountDepositUpdate(Request $request)
    {
        $request->validate([
            'account' => 'required',
            'balance' => 'required|min:1'
        ]);

        $account = $this->account->findOrFail($request->account);
        $account->balance = $account->balance + $request->balance;

        $account->save();

        return redirect()->route('account.index');
    }

    public function accountWithdraw()
    {
        $all_accounts = $this->account->get();

        return view('account.withdraw')
            ->with('all_accounts', $all_accounts);
    }

    public function accountWithdrawUpdate(Request $request)
    {
        $account = $this->account->findOrFail($request->account);

        $request->validate([
            'account' => 'required',
            'balance' => 'required|min:1|max:'. $account->balance
        ],
        ['balance.max' => 'your current balance is $'. $account->balance,
         'balance.min' => 'cannot input negative or zero amount'
        ]);

        $account->balance -= $request->balance;
        $account->save();

        return redirect()->route('account.index');
    }


}
