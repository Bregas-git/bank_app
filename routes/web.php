<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LoanController;

Auth::routes();

Route::group(['middleware'=>'auth'], function(){

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Account
    Route::get('/accounts',[AccountController::class,'accountIndex'])->name('account.index');
    Route::get('/accounts/create',[AccountController::class,'accountCreate'])->name('account.create');
    Route::post('/accounts/save',[AccountController::class,'accountSave'])->name('account.save');

    //Deposit
    Route::get('/accounts/deposit',[AccountController::class,'accountDeposit'])->name('account.deposit');
    Route::patch('/accounts/deposit/update',[AccountController::class,'accountDepositUpdate'])->name('account.deposit.update');

    //Withdraw
    Route::get('/accounts/withdraw', [AccountController::class, 'accountWithdraw'])->name('account.withdraw');
    Route::patch('/accounts/withdraw/update',[AccountController::class,'accountWithdrawUpdate'])->name('account.withdraw.update');

    // get balance
    Route::get('/accounts/{id}/balance', [AccountController::class, 'getBalance'])->name('account.balance');

    //Loan
    Route::get('/loan',[LoanController::class,'index'])->name('loan.index');
    Route::get('/loan/apply',[LoanController::class, 'applyLoan'])->name('loan.apply');
    Route::post('/loan/term',[LoanController::class, 'applyLoanTerm'])->name('loan.term');
    Route::get('/loan/calculate', [LoanController::class, 'applyLoanCalculate'])->name('loan.calculate');
    Route::patch('/loan/save', [LoanController::class, 'executeLoan'])->name('loan.save');


    //Payment
    Route::get('/payment', [LoanController::class,'paymentIndex' ])->name('payment');
    Route::get('/payment/account', [LoanController::class, 'paymentAccount'])->name('payment.account');
    Route::post('/payment/term', [LoanController::class, 'paymentTerm'])->name('payment.term');
    Route::post('/payment/{id}/details', [LoanController::class, 'paymentDetails'])->name('payment.details');
    Route::patch('/payment/{id}/execute', [LoanController::class, 'paymentExecute'])->name('payment.execute');

});
