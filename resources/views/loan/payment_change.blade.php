@extends('layouts.app')

@section('title', 'Payment Term')

@section('content')
<div class="text-success text-center">
    <h2 class="display-3 mb-4">Thank you for paying!</h2>
    <h4 class="h4 text-success">Your change: {{number_format($change, 2, '.', ',')}}</h4>

    <a href="{{ route('payment') }}" class="btn btn-warning">Back to Payment</a>
</div>

@endsection
