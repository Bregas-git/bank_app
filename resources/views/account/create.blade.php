@extends('layouts.app')

@section('title', 'Create Account')

@section('content')
<div class="text-primary text-center">
    <i class="fa-solid fa-money-bill-wave fa-5x"></i>
    <h3>New Account</h3>
</div>

<form action="{{ route('account.save')}}" method="post">
    @csrf

    <div class="input-group col-8 mb-2">
        <span>Initial Balance</span>
        <span class="input-group-text ms-2">$</span>
        <input type="text" name="balance" id="balance" class="form-control bg-white text-black">
    </div>
    <div class="text-end">
        <button class="btn btn-primary me-1">Create</button>
        <a href="{{ route('account.create')}}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

@endsection
