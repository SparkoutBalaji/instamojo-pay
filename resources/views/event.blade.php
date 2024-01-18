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
    <div class="col-lg-12 mt40">
        <div class="card-header" style="background: #0275D8;">
            <h2>Register for Event</h2>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Opps!</strong> Something went wrong<br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
