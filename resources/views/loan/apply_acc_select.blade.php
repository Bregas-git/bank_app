@extends('layouts.app')

@section('title', 'Apply Loan to Account')

@section('content')
<div class="text-warning text-center">
    <i class="fa-solid fa-hand-holding-dollar fa-5x mb-2"></i>
    <h2 class="display-3 mb-4">Loans</h2>
</div>

<h1>Please Select an account for your loan</h1>

<div class="row justify-content-center">
    <div class="col-6">
        <form action="{{ route('loan.term') }}" method="post">
        @csrf
            <select name="account" id="account" class="form-select mb-3" >
                <option value="" class="text-secondary">-</option>
                @forelse ($all_accounts as $account)
                @if ($account->user_id === Auth::user()->id)
                    @if ($account->balance >= 10000)
                    <option value={{ $id = $account->id}}>
                        Account: {{$account->id}} - $ {{$account->balance}}
                    </option>

                    @elseif($account->balance <= 10000)
                        <option value="" disabled class="text-secondary">
                            Account: {{$account->id}} - $ {{$account->balance}} - NOT ELIGIBLE
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
