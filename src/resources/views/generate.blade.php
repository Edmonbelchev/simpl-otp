@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Generate OTP</h2>
    <form action="{{ route('simplotp.generate') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="identifier">Identifier (e.g., email):</label>
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
@endsection