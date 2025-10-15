@extends('layouts.app')

@section('title', 'Apply Loan to Account')

@section('content')
    <div class="text-warning text-center mb-3">
        <i class="fa-solid fa-hand-holding-dollar fa-5x mb-2"></i>
        <h2 class="display-3 mb-3">Loans</h2>
        <h1 class="text-light">Please Select an account for your loan</h1>
    </div>


    <div class="row justify-content-center">
        <div class="col-10">
            <form action="{{ route('loan.term') }}" method="post">
                @csrf
                <select name="account" id="account" class="form-select mb-3" required>
                    <option value="" class="text-secondary">-</option>
                    @forelse ($all_accounts as $account)
                        @if ($account->user_id === Auth::user()->id)
                            @if ($account->balance >= 10000)
                                <option value={{ $id = $account->id }}>
                                    Account: {{ $account->id }} - $ {{ $account->balance }}
                                </option>
                            @elseif($account->balance <= 10000)
                                <option value="" disabled class="text-secondary">
                                    Account: {{ $account->id }} - $ {{ $account->balance }} - NOT ELIGIBLE
                                </option>
                            @endif
                        @endif
                    @empty

                    @endforelse
                </select>
                <div class="row align-items-center">
                    <div class="col-6">
                        <a href="{{ route('loan.index') }}" class="link-danger link-underline-opacity-50"><i
                                class="fa-solid fa-xmark text-danger"></i> Cancel</a>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-warning btn-sm w-auto text-center float-end">Next <i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>

            </form>
        </div>
    </div>


@endsection
