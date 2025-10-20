@extends('layouts.app')

@section('title', 'Payment Account')

@section('content')
<div class="text-warning text-center">
    <i class="fa-solid fa-money-bill-transfer fa-5x mb-2"></i>
    <h2 class="display-3 mb-4">Payment</h2>
</div>

<h1 class="text-center text-white">Please Select an account for your payment</h1>

<div class="row justify-content-center">
    <div class="col-8">
        <form action="{{ route('payment.term') }}" method="post">
        @csrf
            <select name="loan_id" id="loan_id" class="form-select mb-3" >
                <option value="" class="text-secondary">-</option>
                @forelse ($all_loan as $loan)

                @if ($loan->account->user_id === Auth::user()->id)
                    @if ($loan->total_amount)
                    <option value="{{$loan->id}}">
                        Account: {{$loan->account_id}} - $ {{number_format($loan->total_amount, 2, '.', ',')}} [ACTIVE LOAN]
                    </option>

                    @elseif ($loan->total_amount === null ?? 'none')
                    <option value= "" disabled class="text-secondary">
                        Account: {{$loan->account_id}} - $ 0 [NO ACTIVE LOAN]
                    </option>

                    @endif
                @endif
                @empty

                @endforelse
            </select>

            <button type="submit" class="btn btn-warning w-100 text-center">Next</button>
        </form>
    </div>
</div>

@endsection
