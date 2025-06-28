@extends('layouts.app')

@section('title', 'Payment Term')

@section('content')
<div class="text-warning text-center">
    <i class="fa-solid fa-money-bill-transfer fa-5x mb-2"></i>
    <h2 class="display-3 mb-4">Payment</h2>
    <h4 class="h4 text-danger">Account Number: {{$selected_loan->account_id}}</h4>
</div>

<h1 class="text-center text-white mb-4">Please type the number of months you would like to repay your loan</h1>

<div class="row justify-content-center">
    <div class="col-8">
        <form action="{{route('payment.details',$selected_loan->id)}}" method="post">
        @csrf

        <input type="text" name="term" id="term" class="form-control mb-3" min="1">

            <button type="submit" class="btn btn-warning w-100 text-center">Pay</button>
        </form>
    </div>
</div>

@endsection
