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
                    <div class="btn-group radio-deselect">
                        @foreach ($all_accounts as $account)
                            <input type="radio" name="account" id="account-{{ $account->id }}" class="btn-check"
                                value="{{ $account->id }}" required>
                            <label for="account-{{ $account->id }}" class="btn btn-outline-danger">{{ $account->id }}</label>
                        @endforeach
                        @empty('account')
                            <p class="text-secondary small">No accounts available</p>
                        @endempty
                    </div>
                </div>
            </div>
            {{-- current amount --}}
            <div class="row my-3 align-items-center">
                <div class="col-4 text-end">
                    <span>Current balance</span>
                </div>
                <div class="col-8 h5">
                    <span>$ <span id="balance-display">--</span></span>
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
                            placeholder="Enter your withdrawal amount here" min="1" max="" required>
                    </div>
                </div>
                @error('balance')
                <div class="row align-items-center">
                    <p class="text-danger small">{{ $message }}</p>
                </div>
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
            const balanceDisplay = document.getElementById('balance-display');
            const balanceInput = document.getElementById('balance');

            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const accountId = this.value;

                    fetch(`/accounts/${accountId}/balance`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.balance !== null) {
                                balanceDisplay.textContent = data.balance.toLocaleString('en-US');

                                balanceInput.max = data.balance;

                            } else {
                                balanceInput.removeAttribute('max');
                            }
                        })

                        .catch(err => {
                            console.error('Error fetching balance:', err);
                            balanceDisplay.textContent = 'Error fetching balance';
                            balanceInput.removeAttribute('max');
                        });
                });
            });
        });
    </script>

@endsection
