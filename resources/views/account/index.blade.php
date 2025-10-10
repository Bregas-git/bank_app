@extends('layouts.app')

@section('title', 'Accounts')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="row justify-content-center">
                <div class="col-6 mb-4 text-end">
                    <h2 class="h2">Account List</h2>
                </div>
                {{-- add account link --}}
                <div class="col-4">
                    <a href="{{ route('account.create') }}">
                        <i class="fa-solid fa-square-plus fa-2x"></i>
                    </a>
                </div>
            </div>

            {{-- account list --}}
            @forelse ($all_accounts as $account)
                <div class="card pt-3 px-3">
                    <h4>Savings account</h4>
                    <p>ID: {{ $account->id }}</p>
                    <p>Name: {{ Auth::user()->name }}</p>
                    <p class="text-end h3">$ {{ $account->balance }}</p>
                    <p class="text-end">Available balance</p>
                </div>
            @empty
                <div class="card text-center p-5">
                    <p>No Bank Account Yet</p>
                    <p><a href="{{ route('account.create') }}">Add bank account</a></p>
                </div>
            @endforelse
        </div>
    </div>

@endsection
