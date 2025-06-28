@extends('layouts.app')

@section('title', 'Payment')

@section('content')
<div class="text-warning text-center">
    <i class="fa-solid fa-money-bill-transfer fa-5x mb-2"></i>
    <h2 class="display-3 mb-4">Payment</h2>
</div>
<div class="table table-responsive">
    <table class="table table-hover">
        <thead class="small">
            <tr>
                <th>Account Number</th>
                <th>Acccount Balance</th>
                <th>Loaned Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($user_accounts as $account)
            <tr>
                <td>{{$account->id}}</td>
                <td>$ {{$account->balance}}</td>

                @if ($account->loan->total_amount ?? 'none')
                    <td class="text-success">$ {{$account->loan->total_amount ?? '0'}}</td>

                @elseif($account->loan->total_amount == null)
                    <td class="text-success">$ 0</td>
                @endif


                @if ($account->loan)
                    <td class="text-danger">ACTIVE LOAN</td>

                @elseif($account->balance <= 15000)
                    <td class="text-secondary">NOT ELIGIBLE</td>

                @else
                    <td class="text-secondary"> NO LOAN</td>

                @endif
            @empty

            @endforelse
            </tr>
        </tbody>
    </table>

    <a href="{{ route ('payment.account')}}" class="btn btn-warning w-100 fw-bold">Pay Loan</a>


@endsection
