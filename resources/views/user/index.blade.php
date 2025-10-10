@extends('layouts.app')

@section('title', 'Index')

@section('content')
    <div class="container">

        <h1 class="h1 mb-5">
            Good day, {{ Auth::user()->name }}!
        </h1>
        <div class="container">
            <div class="row mb-3 justify-content-center">
                <div class="card border-0">
                    <div class="card-header border-0 bg-info">
                        <p class="card-title fw-bold text-black">Announcements</p>
                    </div>
                    <div class="card-body bg-light text-black w-auto">
                        <p class="card-text">Welcome to Kredo Bank</p>
                    </div>
                </div>
                {{-- cards parent --}}
                <div class="row mb-3">
                    {{-- Deposit card --}}
                    <div class="card bg-success col-md-3 text-center p-3 g-2">
                        <a href="{{ route('account.deposit') }}" class="text-decoration-none text-light">
                            <h3 class="h3">Deposit</h3>
                            <i class="fa-solid fa-circle-dollar-to-slot fa-4x"></i>
                        </a>
                    </div>
                    {{-- Withdraw card --}}
                    <div class="card bg-danger col-md-3 text-light text-center p-3 g-2">
                        <a href="{{ route('account.withdraw') }}" class="text-decoration-none text-light">
                            <h3 class="h3">Withdraw</h3>
                            <i class="fa-solid fa-money-bill-wave fa-4x"></i>
                        </a>
                    </div>
                    {{-- Loans card --}}
                    <div class="card bg-warning col-md-3 text-center p-3 g-2">
                        <a href="{{ route('loan.index') }}" class="text-decoration-none text-dark">
                            <h3 class="h3">Loans</h3>
                            <i class="fa-solid fa-hand-holding-dollar fa-4x"></i>
                        </a>
                    </div>
                    {{-- payment card --}}
                    <div class="card bg-success col-md-3 text-center p-3 g-2">
                        <a href="{{ route('payment') }}" class="text-decoration-none text-light">
                            <h3 class="h3">Payment</h3>
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
