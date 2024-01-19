<!DOCTYPE html>
<html lang="en">

<head>
    <title>Requests List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-3">
        <h2>Payment Requests List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($response as $paymentRequest)
                    <tr>
                        {{-- <td>{{ $paymentRequest->id }}</td>
                        <td>{{ $paymentRequest->email }}</td>
                        <td>{{ $paymentRequest->amount }}</td>
                        <td>
                            <form action="/request/id" method="post" style="display: inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $paymentRequest->id }}">
                                <button type="submit" class="btn btn-success">Request Detail</button>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
