@extends('layouts.app')

@section('title', 'Loan Details')

@section('content')

    <div class="text-warning text-center">
        <i class="fa-solid fa-hand-holding-dollar fa-5x mb-2"></i>
        <h2 class="display-3 mb-4">Loans</h2>
    </div>
    <form action="{{ route('loan.save') }}" method="post">
        @csrf
        @method('PATCH')
        <table class="table">
            <thead>
                <tr class="text-center">
                    <td colspan="2" class="h5 mb-3">Confirm Your Loan</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Account Number</td>
                    <td>{{ $account }}</td>
                    <input type="hidden" name="account_id" value={{ $account }}>
                </tr>

                <tr>
                    <td>Loan Term</td>
                    <td>{{ $term }} months</td>
                    {{-- for loan table loan_term column --}}
                    <input type="hidden" name="loan_term" value={{ $term }}>
                </tr>
                <tr>
                    <td>Loan Amount</td>
                    <td>{{ $loanable }}</td>
                    {{-- for loan table loan_amount --}}
                    <input type="hidden" name="loan_amount" value={{ $loanable }}>
                </tr>
                <tr>
                    <td>Interest</td>
                    <td>
                        @if ($term == 3)
                            2%
                            {{-- for loan table interest column --}}
                            <input type="hidden" name="interest" value= "2">
                        @elseif ($term == 6)
                            5%
                            {{-- for loan table interest column --}}
                            <input type="hidden" name="interest" value= "5">
                        @elseif ($term == 12)
                            7%
                            {{-- for loan table interest column --}}
                            <input type="hidden" name="interest" value= "7">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td>
                        @if ($term == 3)
                            {{ $total_loan = $loanable + $loanable * 0.02 }}
                        @elseif ($term == 6)
                            {{ $total_loan = $loanable + $loanable * 0.05 }}
                        @elseif ($term == 12)
                            {{ $total_loan = $loanable + $loanable * 0.07 }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Monthly payment</td>
                    <td>{{ $monthly = $total_loan / $term }}</td>
                    <input type="hidden" name="account" value={{ $account }}>

                    {{-- loan & account table --}}
                    {{-- loan table -> total_amount --}}
                    {{-- account table -> balance + total_loan --}}
                    <input type="hidden" name="total_loan" value={{ $total_loan }}>

                    {{-- loan table monthly_payment column --}}
                    <input type="hidden" name="monthly_payment" value={{ $monthly }}>

                </tr>
            </tbody>
        </table>

        <div class="row align-items-center">
            {{-- back feature WIP : method unsupported --}}
            {{-- <div class="col-4">
                <a href="{{ route('loan.term') }}" class="link-secondary link-underline-opacity-50"><i
                        class="fa-solid fa-chevron-left text-secondary"></i> back</a>
            </div> --}}
            <div class="col-6 text-center">
                <a href="{{ route('loan.index') }}" class="link-danger link-underline-opacity-50"><i
                        class="fa-solid fa-xmark text-danger"></i> Cancel</a>
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-warning  btn-sm w-auto text-center float-end">Confirm Loan <i class="fa-solid fa-check"></i></button>
            </div>
        </div>
    </form>
@endsection
