@extends('layouts.app')

@section('title', 'Withdrawal')

@section('content')

    @if (Auth::user()->account->isNotEmpty())
        <div class="text-danger text-center">
            <i class="fa-solid fa-circle-dollar-to-slot fa-5x mb-2"></i>
            <h2 class="mb-3">Withdrawal</h2>
        </div>
        <form action="{{ route('account.withdraw.update') }}" method="POST">
            @csrf
            @method('PATCH')
            {{-- account select row --}}
            <div class="row mb-2 align-items-center">
                <div class="col-4 text-end">
                    <p>Account</p>
                </div>
                <div class="col-8 ps-3">
                    <div class="btn-group">

                        @foreach ($all_accounts as $account)
                            <input type="radio" name="account" id="{{ $account->id }}" class="btn-check"
                                value="{{ $account->id }}">
                            <label for="{{ $account->id }}" class="btn btn-outline-danger">{{ $account->id }}</label>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- current amount --}}
            <div class="row my-3 align-items-center">
                <div class="col-4 text-end">
                    <span>Current balance</span>
                </div>
                <div class="col-8 h5">
                    <span >$ <span id="balance-display">--</span></span>
                </div>
            </div>

            {{-- widthdraw amount --}}
            <div class="row align-items-center">
                <div class="col-4 text-end">
                    <p>Withdrawal Amount</p>
                </div>
                <div class="col-8 mb-2">
                    <div class="input-group">
                        <span class="input-group-text ms-2">$</span>
                        <input type="number" name="balance" id="balance" class="form-control"
                            placeholder="Enter your withdrawal amount here" min="1" max="">
                    </div>
                </div>
                @error('balance')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <div>
                    <button class="btn btn-danger me-1 w-100 mb-3">Withdraw</button>
                    <a href="{{ route('home') }}" class="btn btn-outilne-secondary w-100">Cancel</a>
                </div>

            </div>
        </form>
    @else
        <div class="card bg-dark border-0 mt-5">
            <div class="card-body">
                <h1 class="display-6 text-center text-danger mt-5 mb-3">
                    Please create an account and deposit a balance first.
                </h1>
                <h1 class="display-6 text-center">
                    <i class="fa-solid fa-triangle-exclamation text-danger fa-5x"></i>
                </h1>
            </div>
        </div>
    @endif
    @error('account')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="account"]');
            const display = document.getElementById('balance-display');

            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const accountId = this.value;

                    fetch(`/accounts/${accountId}/balance`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.balance !== null) {
                                display.textContent = data.balance.toLocaleString('en-US')
                            } else {
                                display.textContent = 'No data';
                            }
                        })
                        .catch(err => {
                            console.error('Error fetching balance:', err);
                            display.textContent = 'Error fetch';
                        });
                });
            });
        });
    </script>

@endsection
