@extends('layouts.app')

@section('title', 'Withdrawal')

@section('content')

@if (Auth::user()->account->isNotEmpty())
    <div class="text-danger text-center">
        <i class="fa-solid fa-circle-dollar-to-slot fa-5x mb-2"></i>
        <h2 class="mb-3">Withdrawal</h2>
    </div>


    <div class="row mb-2">
        <div class="col-3">
            <inline>Account</inline>
        </div>
        <div class="col-7">
            <div class="btn-group">
                <form action="{{ route('account.withdraw.update')}}" method="POST">
                    @csrf
                    @method('PATCH')
                    @foreach ($all_accounts as $account)
                        <input type="radio" name="account" id="{{$account->id}}" class="btn-check" value="{{$account->id}}">
                        <label for="{{$account->id}}" class="btn btn-outline-danger">{{$account->id}}</label>
                    @endforeach

                    <div class="input-group col-8 mb-2">
                        <span>Withdrawal Amount</span>
                        <span class="input-group-text ms-2">$</span>
                        <input type="number" name="balance" id="balance" class="form-control" placeholder="Enter your withdrawal amount here" min="1" max="">
                    </div>
                        @error('balance')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror

                        <div>
                        <button class="btn btn-danger me-1 w-100 mb-3">Withdraw</button>
                        <a href="{{ route('home')}}" class="btn btn-outilne-secondary w-100">Cancel</a>
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

@endsection
