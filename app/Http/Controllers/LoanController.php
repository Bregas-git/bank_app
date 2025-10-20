<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    private $user;
    private $loan;
    private $account;

    public function __construct(Loan $loan, Account $account, User $user)
    {
        $this->loan = $loan;
        $this->account = $account;
        $this->user = $user;
    }

    public function index()
    {
        $all_accounts = $this->account->get();

        return view('loan.index')
            ->with('all_accounts', $all_accounts);
    }

    public function applyLoan()
    {//this is the apply_acc_select page
        $all_accounts = $this->account->get();

        return view('loan.apply_acc_select')
            ->with('all_accounts', $all_accounts);
    }

    public function applyLoanTerm(Request $request)
    {   //this is the apply_term_select page
        //this is where the account id is being temporarily recorded
        $request->validate([
            'account' => 'required'
        ]);

        $id = $request->account;

        $balance = $this->account->findOrfail($id);

        return view('loan.apply_term_select')
            ->with('id', $id)
            ->with('balance', $balance);
    }

    public function applyLoanCalculate(Request $request)
    { //this is to go to the loan_details page
        $request->validate([
            'account' => 'required',
            'balance' => 'required',
            'term'    => 'required',
        ]);

        if($request->balance >= 10001 && $request->balance <= 30000){
            $loanable = $request->balance * 0.1;

            }elseif($request->balance >= 30001 && $request->balance <= 50000){
                $loanable = $request->balance * 0.2;

                }elseif($request->balance >= 50001 && $request->balance <= 100000){
                    $loanable = $request->balance * 0.25;

                    }else{
                        $loanable = $request->balance * 0.5;
                    }

        $account = $request->account;
        $balance = $request->balance;
        $term = $request->term;

        return view('loan.loan_details')
                ->with('account', $account)
                ->with('balance', $balance)
                ->with('term', $term)
                ->with('loanable', $loanable);
    }

    public function executeLoan(Request $request)
    {//when the button is pressed the loan will be stored
        // 1st identify and update the new balance
        $id = $request->account;
        $account = $this->account->findOrFail($id);

        $account->balance = $account->balance + $request->total_loan;

        $account->save();

        // 2nd store all loan data from the form
        $this->loan->account_id = $id;
        $this->loan->loan_amount = $request->loan_amount;
        $this->loan->loan_term = $request->loan_term;
        $this->loan->interest = $request->interest;
        $this->loan->monthly_payment = $request->monthly_payment;
        $this->loan->total_amount = $request->total_loan;

        $this->loan->save();

        // $all_accounts = $this->account->get();

        return redirect()->route('account.index');
                // ->with('all_accounts', $all_accounts);
    }

    //to access payment index page
    public function paymentIndex()
    {
        $user_accounts = $this->account->get();

        return view('loan.payment_index')
            ->with('user_accounts', $user_accounts);
    }

    //to access payment account page
    public function paymentAccount()
    {
        $all_loan = $this->loan->get();

        return view('loan.payment_account')
            ->with('all_loan', $all_loan);
    }

    //to access payment term page
    public function paymentTerm(Request $request)
    {
        $loan_id = $request->loan_id;

        $selected_loan = $this->loan->findOrFail($loan_id);

        return view('loan.payment_term')
            ->with('selected_loan', $selected_loan);

    }

    //to access payment details page
    public function paymentDetails(Request $request, $id)
    {
        $request->validate([
            'term' => 'required|integer'
        ]);

        $input_term = $request->term;
        $loan = $this->loan->findOrFail($id);

        return view('loan.payment_details')
            ->with( 'input_term', $input_term)
            ->with('loan', $loan);

    }

    public function paymentExecute(Request $request, $id)
    {
        $pay_amount = $request->pay_amount;
        $amount_due = $request->amount_due;

        $loan = $this->loan->findOrFail($id);

        // if pay is greater than or equal with total loan amount
        if($pay_amount >= $amount_due){

            $change = $pay_amount - $amount_due;

            $loan->total_amount = $loan->total_amount - $pay_amount;
            $loan->save();

            return view('loan.payment_change')
            ->with('change', $change);

        }else{
                $loan->total_amount = $loan->total_amount - $pay_amount;
                $loan->save();

                $user_accounts = $this->account->get();

                return view('loan.payment_index')
                    ->with('user_accounts', $user_accounts);

            }
    }

}
