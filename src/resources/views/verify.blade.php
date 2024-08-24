@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Verify OTP</h2>
    <form action="{{ route('simplotp.verify') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="identifier">Identifier (e.g., email):</label>
            <input type="text" class="form-control" id="identifier" name="identifier" required>
        </div>
        <div class="form-group">
            <label for="token">OTP:</label>
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
@endsection