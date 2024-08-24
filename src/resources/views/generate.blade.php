<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Generate OTP</h2>
        <form action="{{ route('simplotp.generate') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="identifier" class="form-label">Identifier (e.g., email):</label>
                <input type="text" class="form-control" id="identifier" name="identifier" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate OTP</button>
        </form>

        @if(session('otp'))
            <div class="alert alert-success mt-3">
                Your OTP: {{ session('otp') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif
    </div>
</body>
</html>