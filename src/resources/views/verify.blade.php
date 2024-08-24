<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Verify OTP</h2>
        <form action="{{ route('simplotp.verify') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="identifier" class="form-label">Identifier (e.g., email):</label>
                <input type="text" class="form-control" id="identifier" name="identifier" required>
            </div>
            <div class="mb-3">
                <label for="token" class="form-label">OTP:</label>
                <input type="text" class="form-control" id="token" name="token" required>
            </div>
            <button type="submit" class="btn btn-primary">Verify OTP</button>
        </form>

        @if(session('message'))
            <div class="alert alert-info mt-3">
                {{ session('message') }}
            </div>
        @endif
    </div>
</body>
</html>