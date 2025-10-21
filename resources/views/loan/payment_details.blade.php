@extends('layouts.app')

@section('title', 'Payment Details')

@section('content')
    <div class="text-warning text-center">
        <i class="fa-solid fa-money-bill-transfer fa-5x mb-2"></i>
        <h2 class="display-3 mb-4">Payment</h2>
    </div>

    <table class="table">
        <thead>
            <tr>
                <td>Payment Details</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Account ID</td>
                <td>{{ $loan->account_id }}</td>
                {{-- <input type="hidden" name="account_id" value= ""> --}}
            </tr>
            <form action="{{ route('payment.execute', $loan->id) }}" method="post">
                @csrf
                @method('PATCH')
                <tr>
                    <td>Terms Paid</td>
                    <td>{{ $input_term }} months</td>
                    {{-- for loan table loan_term column --}}
                    {{-- <input type="hidden" name="loan_term" value={{$term}}> --}}
                </tr>
                <tr>
                    <td>Paid Amount Per Term:</td>
                    <td>$ {{ number_format($loan->monthly_payment, 2, '.', ',') }}</td>
                    {{-- for loan table loan_amount --}}
                    {{-- <input type="hidden" name="loan_amount" value= {{$loanable}}> --}}
                </tr>
                <tr>
                    <td>Total Amount Due:</td>
                    <td>$ {{ number_format($amount_due = $loan->monthly_payment * $input_term, 2, '.', ',') }}</td>
                    <input type="hidden" name="amount_due" value="{{ $amount_due }}">
                </tr>
        </tbody>
    </table>
    <p class="small fst-italic text-warning">Paid amount will be deducted to your loan amount after confirmation</p>
    <div class="input-group">
        <span for="pay_amount" class="input-group-text" id="pay_amount">$</span>
        <input type="number" name="pay_amount" id="pay_amount" min="0" class="form-control" required>
    </div>
    <div class="row my-3">
        <div class="col">
            <a href="{{ route('payment') }}" class="link-secondary"> cancel </a>
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-warning">Confirm</button>
        </div>
    </div>
    </form>


@endsection
