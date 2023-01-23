@extends('layout.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Top Up')
    <style>
        .form-control {
            background-color: #bebebe !important;
        }
    </style>
</head>

<body>
    @section('content')
        <div class="mt-5">
            <form action="{{ url("/balance/topup/save") }}" method="POST" style="font-size: 24px">
                @csrf
                <h1 class="my-5">Topup Balance</h1>
                <div class="mb-3">
                    <label for="balance-total">Total:</label>
                    <input type="number" class="form-control" id="balance-total" placeholder="Enter topup amount"
                        name="total" step="any">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    @endsection
</body>

</html>
