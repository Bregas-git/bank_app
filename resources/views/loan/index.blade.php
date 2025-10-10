@extends('layouts.app')

@section('title', 'loans')

@section('content')
    <div class="text-warning text-center">
        <i class="fa-solid fa-hand-holding-dollar fa-5x mb-2"></i>
        <h2 class="display-3 mb-5">Loans</h2>
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

                @forelse ($all_accounts as $account)
                    <tr>
                        <td>{{ $account->id }}</td>
                        <td>{{ $account->balance }}</td>

                        @if ($account->loan->loan_amount ?? 'none')
                            <td class="text-success">$ {{ $account->loan->loan_amount ?? '0' }}</td>
                        @endif

                        @if ($account->balance >= 10000 && $account->loan == null ?? 'none')
                            <td class="text-primary">ELIGIBLE</td>
                        @elseif($account->balance >= 10000 && $account->loan)
                            <td class="text-danger">ACTIVE LOAN</td>
                        @else
                            <td class="text-secondary">NOT ELIGIBLE</td>
                        @endif
                    @empty
                @endforelse
                </tr>
            </tbody>
        </table>

        @if ($account->loan?->loan_amount > 1)
            <div class="mt-4 text-danger text-center">
                <i class="fa-solid fa-triangle-exclamation fa-5x"></i>
                <h4>You have an active loan, please settle your loan before applying for new one</h4>
            </div>
        @else
            <div class="mt-4 text-secondary text-center">
                <h5>you have no active loan</h5>
                <p>lets keep it that way</p>
            </div>
        @endif

        <div class="text-center">
            <a href="{{ route('loan.apply') }}" class="btn btn-warning w-50 fw-bold">Apply Loan</a>
        </div>
    </div>
@endsection
