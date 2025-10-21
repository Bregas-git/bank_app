@extends('layouts.app')

@section('title', 'Payment Term')

@section('content')
    <div class="text-warning text-center">
        <i class="fa-solid fa-money-bill-transfer fa-5x mb-2"></i>
        <h2 class="display-3 mb-4">Payment</h2>
        <div class="row h4">
            <h4 class="text-secondary">Account No: <b class="text-light">{{ $selected_loan->account_id }}</b></h4>
            <h4 class="text-secondary">Loan Amount: <b class="text-light">$
                    {{ number_format($selected_loan->loan_amount, 2, '.', ',') }}</b></h4>
            <h4 class="text-secondary">Loan term: <b class="text-light">{{ $selected_loan->loan_term }} months</b></h4>
        </div>
    </div>

    <h1 class="text-center text-white mb-4">Please type the number of months you would like to repay your loan</h1>

    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{ route('payment.details', $selected_loan->id) }}" method="post">
                @csrf

                <input type="number" name="term" id="term" class="form-control mb-3" min="1"
                    max="{{ $selected_loan->loan_term }}" required>

                <button type="submit" class="btn btn-warning w-100 text-center">Select</button>
            </form>
        </div>
    </div>

@endsection
