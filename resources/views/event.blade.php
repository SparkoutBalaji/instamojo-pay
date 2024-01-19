<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Instamojo Payment Gateway Integrate - Tutsmake.com</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <style>
        .mt40{
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="container">

<div class="row">
    {{-- <div class="col-lg-12 mt40">
        <div class="card-header" style="background: #0275D8;">
            <h2>Register for Event</h2>
        </div>
    </div> --}}
    <div class="col-lg-12 mt40">
        <div class="card-header" style="background: #0275D8;">
            <h2>Register for Event</h2>
        </div>
        <!-- Your card content goes here -->
        <div class="col-md-12">
            @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Error Alert!</strong> {{ $message }}
            </div>
            @endif
            {!! Session::forget('error') !!}
            @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Success Alert!</strong> {{ $message }}
            </div>
            @endif
            {!! Session::forget('success') !!}
        </div>

        <form action="{{ url('pay') }}" method="POST" name="laravel_instamojo">
            {{ csrf_field() }}

             <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Purpose</strong>
                        <input type="text" name="purpose" class="form-control" placeholder="Enter Purpose" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>amount</strong>
                        <input type="text" name="amount" class="form-control" placeholder="Enter amount" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>phone</strong>
                        <input type="text" name="phone" class="form-control" placeholder="Enter phone" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>username</strong>
                        <input type="text" name="username" class="form-control" placeholder="Enter username" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>email</strong>
                        <input type="text" name="email" class="form-control" placeholder="Enter email" required>
                    </div>
                </div>

                <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
        </div>

        </body>
        </html>

        <!-- Add the "Requests List" button at the end of the card -->
        <div class="card-footer" style="text-align: right;">
            <a href="/request/lists" class="btn btn-success">Requests List</a>
            {{-- <a href="/request/lists" class="btn btn-warning">Payment List</a> --}}

        </div>
    </div>
</div>

