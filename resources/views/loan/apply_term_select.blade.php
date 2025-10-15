@extends('layouts.app')

@section('title', 'Apply Loan to Account')

@section('content')
    <div class="text-warning text-center">
        <i class="fa-solid fa-hand-holding-dollar fa-5x mb-2"></i>
        <h2 class="display-3 mb-4">Loans</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-auto">
            <h3 class="h5">Account No : {{ $id }}</h3>
        </div>
        <div class="col-auto">
            <h3 class="h5">Balance : $ {{ $balance->balance }}</h3>
        </div>
    </div>

    <h1 class="text-center m-4 h3">How many months would you like for your loan term?</h1>
    <div class="row justify-content-center">
        <div class="col-8 text-center mb-4">
            <form action="{{ route('loan.calculate') }}" method="post">
                @csrf
                @method('GET')

                <div class="btn-group" role="group">
                    <input type="radio" name="term" id="month_3" class="btn-check" value=3>
                    <label for="month_3" class="btn btn-outline-success"> 3 Months</label>

                    <input type="radio" name="term" id="month_6" class="btn-check" value=6>
                    <label for="month_6" class="btn btn-outline-success"> 6 Months</label>

                    <input type="radio" name="term" id="month_12" class="btn-check" value=12>
                    <label for="month_12" class="btn btn-outline-success"> 12 Months</label>
                </div>
                <input type="hidden" name="account" value={{ $id }}>
                <input type="hidden" name="balance" value={{ $balance->balance }}>

        </div>
        <div class="row align-items-center">
            <div class="col-4 text-start">
                <a href="{{ url()->previous() }}" class="link-secondary link-underline-opacity-50"><i
                        class="fa-solid fa-chevron-left text-secondary"></i> back</a>
            </div>
            <div class="col-4 text-center">
                <a href="{{ route('loan.index') }}" class="link-danger link-underline-opacity-50"><i
                        class="fa-solid fa-xmark text-danger"></i> Cancel</a>
            </div>
            <div class="col-4 align-items-end">
                <button type="submit" class="btn btn-warning btn-sm w-auto text-center float-end">Compute <i
                        class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
        </form>
    </div>



@endsection
