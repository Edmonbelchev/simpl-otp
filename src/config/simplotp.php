<?php

return [
    'success_messages' => [
        'otp_generated' => 'OTP generated',
        'otp_valid' => 'OTP is valid',
    ],
    'error_messages' => [
        'invalid_type' => 'Invalid OTP type',
        'expired_otp' => 'OTP Expired',
        'invalid_otp' => 'Invalid OTP',
        'otp_not_found' => 'OTP not found',
    ],
    'otp' => [
        'length' => 4,
        'type' => 'numeric',
        'validity' => 15,
    ]
];
