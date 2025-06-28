@extends('layouts.app')

@section('title', 'Loan Details')

@section('content')
<div class="text-warning text-center">
    <i class="fa-solid fa-hand-holding-dollar fa-5x mb-2"></i>
    <h2 class="display-3 mb-4">Loans</h2>
</div>

<table class="table">
    <thead>
        <tr>
            <td>Loan Details</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Account Number</td>
            <td>{{$account}}</td>
            <input type="hidden" name="account_id" value= {{$account}}>
        </tr>
            <form action="{{ route('loan.save')}}" method="post">
                @csrf
                @method('PATCH')
        <tr>
            <td>Loan Term</td>
            <td>{{$term}} months</td>
            {{-- for loan table loan_term column --}}
            <input type="hidden" name="loan_term" value={{$term}}>
        </tr>
        <tr>
            <td>Loan Amount</td>
            <td>{{$loanable}}</td>
            {{-- for loan table loan_amount --}}
            <input type="hidden" name="loan_amount" value= {{$loanable}}>
        </tr>
        <tr>
            <td>Interest</td>
            <td>
                @if ($term==3)
                    2%
                    {{-- for loan table interest column --}}
                    <input type="hidden" name="interest" value= "2" >
                @elseif ($term==6)
                    5%
                    {{-- for loan table interest column --}}
                    <input type="hidden" name="interest" value= "5" >
                @elseif ($term==12)
                    7%
                    {{-- for loan table interest column --}}
                    <input type="hidden" name="interest" value= "7" >
                @endif
            </td>
        </tr>
        <tr>
            <td>Total Amount</td>
            <td>
                @if ($term == 3)
                {{$total_loan = $loanable + ($loanable * 0.02)}}

                @elseif ($term == 6)
                {{$total_loan = $loanable + ($loanable * 0.05)}}

                @elseif ($term == 12)
                {{$total_loan = $loanable + ($loanable * 0.07)}}

                @endif
            </td>
        </tr>
        <tr>
            <td>Monthly payment</td>
            <td>{{$monthly = $total_loan / $term}}</td>
                <input type="hidden" name="account" value={{$account}}>

                {{-- loan & account table --}}
                {{-- loan table -> total_amount --}}
                {{-- account table -> balance + total_loan --}}
                <input type="hidden" name="total_loan" value={{$total_loan}}>

                {{-- loan table monthly_payment column --}}
                <input type="hidden" name="monthly_payment" value={{$monthly}}>

        </tr>
    </tbody>
</table>

<button type="submit" class="btn btn-warning w-100">Loan</button>
</form>


@endsection
