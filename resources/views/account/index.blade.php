@extends('layouts.app')

@section('title', 'Accounts')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-4 mb-4">
            <h2 class="h2">Account List</h2>
        </div>
        <div class="col-4">
            <a href="{{ route('account.create')}}">
                <i class="fa-solid fa-square-plus fa-2x"></i>
            </a>
        </div>
        @forelse ($all_accounts as $account)
        <div class="card pt-3 px-3">
            <h4>Savings account</h4>
            <p>ID: {{$account->id}}</p>
            <p>Name: {{Auth::user()->name}}</p>
            <p class="text-end h3">$ {{$account->balance}}</p>
            <p class="text-end">Available balance</p>
        </div>
        @empty
            <div class="card text-center p-5">
                <p>No Users Added Yet</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
