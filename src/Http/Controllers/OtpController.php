<?php

namespace TechEd\SimplOtp\Http\Controllers;

use Illuminate\Http\Request;
use TechEd\SimplOtp\SimplOtp;

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

        if ($result->status) {
            return back()->with('otp', $result->token);
        }

        return back()->with('error', $result->message);
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

        return back()->with('message', $result->message);
    }
}