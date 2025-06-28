@extends('layouts.app')

@section('title', 'Index')

@section('content')
<div class="container">

    <h1 class="h1 mb-5">
        Good day, {{Auth::user()->name}}!
    </h1>
    <div class="container">
        <div class="row mb-3">
            <div class="card border-0 bg-info border-0 mb-3 pt-2">
                    <p class="fw-bold text-black">Announcements</p>
                <div class="card-body bg-light text-black">
                    <p class="">Welcome to Kredo Bank</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="card bg-success col-3 text-center p-3">
                    <a href="{{ route('account.deposit') }}" class="text-decoration-none text-light">
                        <h3 class="h2">Deposit</h3>
                        <i class="fa-solid fa-circle-dollar-to-slot fa-4x"></i>
                    </a>
                </div>
                <div class="card bg-danger col-3 text-light text-center p-3">
                    <a href="{{ route('account.withdraw')}}" class="text-decoration-none text-light">
                        <h3 class="h2">Withdraw</h3>
                        <i class="fa-solid fa-money-bill-wave fa-4x"></i>
                        </a>
                </div>
                <div class="card bg-warning col-3 text-center p-3">
                    <a href="{{ route('loan.index') }}" class="text-decoration-none text-dark">
                        <h3 class="h2">Loans</h3>
                        <i class="fa-solid fa-hand-holding-dollar fa-4x"></i>
                        </a>
                </div>
                <div class="card bg-success col-3 text-center p-3">
                    <a href="{{ route('payment') }}" class="text-decoration-none text-light">
                        <h3 class="h2">Payment</h3>
                        <i class="fa-solid fa-money-bill-transfer fa-4x"></i>
                    </a>
                </div>
            </div>
            <div class="card bg-secondary text-center py-3">
                <a href="{{ route('account.index') }}" class="text-decoration-none text-light">
                    <h3 class="h2">Accounts</h3>
                    <i class="fa-solid fa-money-check-dollar fa-4x"></i>
                </a>
            </div>
        </div>
    </div>
</div>


@endsection
