@extends('layouts.app')

@section('title', 'Create Account')

@section('content')
    <div class="text-success text-center">
        <i class="fa-solid fa-circle-dollar-to-slot fa-5x mb-2"></i>
        <h2 class="mb-3">Deposit</h2>
    </div>
    <form action="{{ route('account.deposit.update') }}" method="post">
        @csrf
        @method('PATCH')
        {{-- account select --}}
        <div class="row mb-2">
            <div class="col-3 text-end">
                <span>Account</span>
            </div>
            <div class="col-7 ps-3">
                <div class="btn-group radio-deselect">
                    @forelse ($all_accounts as $account)
                        <input type="radio" name="account" id="{{ $account->id }}" class="btn-check"
                            value="{{ $account->id }}" required>
                        <label for="{{ $account->id }}" class="btn btn-outline-success">{{ $account->id }}</label>
                    @empty
                        <p class="text-secondary">No accounts available</p>
                    @endforelse
                </div>
            </div>
        </div>
        {{-- current amount --}}
        <div class="row my-3 align-items-center">
            <div class="col-3 text-end ">
                <span>Current balance</span>
            </div>
            <div class="col-7 h5">
                <span>$ <span id="balance-display">--</span></span>
            </div>
        </div>
        {{-- deposit amount --}}
        <div class="row">
            <div class="col-3 text-end">
                <span>Deposit Amount</span>
            </div>
            <div class="input-group col-7 mb-2 w-75">
                <span class="input-group-text ms-2">$</span>
                <input type="number" name="balance" id="balance" class="form-control"
                    placeholder="Enter your deposit amount here" min="1" autofocus>
            </div>
        </div>

        @error('balance')
            <p class="text-danger small">{{ $message }}</p>
        @enderror

        <div class="text-center">
            <button class="btn btn-success me-1 w-100 mb-3">Deposit</button>
            <a href="{{ route('home') }}" class="btn btn-outilne secondary text-center">Cancel</a>
        </div>
    </form>

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
                                display.textContent = data.balance.toLocaleString('en-US', {
                                    maximumFractionDigits: 2,
                                })
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


        document.addEventListener('DOMContentLoaded',function(){
            const radios = document.querySelectorAll('.radio-deselect input[type="radio"]');
            radios.forEach(radio => {
                radio.checked = false;
                radio.defaultChecked = false;
            });
        });

    </script>

@endsection
