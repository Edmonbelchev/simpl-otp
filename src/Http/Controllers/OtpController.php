<?php

namespace TechEd\SimplOtp\Http\Controllers;

use Illuminate\Http\Request;
use TechEd\SimplOtp\SimplOtp;
use App\Http\Controllers\Controller;

class OtpController extends Controller
{
    public function showGenerateForm()
    {
        return view('simplotp::generate');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
        ]);

        $result = SimplOtp::generate($request->identifier);

        $result->status 
                ? session()->flash('otp', $result->token)
                : session()->flash('error', $result->message);

        return view('simplotp::generate');
    }

    public function showVerifyForm()
    {
        return view('simplotp::verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'token' => 'required|string',
        ]);

        $result = SimplOtp::validate($request->identifier, $request->token);

        session()->flash('message', $result->message);

        return view('simplotp::verify');
    }
}