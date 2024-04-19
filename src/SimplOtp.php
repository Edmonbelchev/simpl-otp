<?php

namespace TechEd\SimplOtp;

use TechEd\SimplOtp\Models\SimplOtp as OTPModel;

class SimplOtp
{
    protected const DEFAULT_SUCCESS_MESSAGES = [
        'otp_generated' => 'OTP generated',
        'otp_valid' => 'OTP is valid',
    ];

    protected const DEFAULT_ERROR_MESSAGES = [
        'invalid_type' => 'Invalid OTP type',
        'expired_otp' => 'OTP Expired',
        'invalid_otp' => 'OTP is not valid',
        'otp_not_found' => 'OTP does not exist',
    ];

    /**
     * Generate an OTP.
     *
     * @param string $identifier The identifier associated with the OTP
     * @return object The generated OTP
     */
    public static function generate(string $identifier): object
    {
        // Get the OTP type and validity from the config
        $type = config('simplotp.otp.type', 'numeric');
        $validity = config('simplotp.otp.validity', 15);
        
        // Check if type is not numeric or alphanumeric
        if (!in_array($type, ['numeric', 'alphanumeric'])) {
            return (object)[
                'status' => false,
                'message' => config('simplotp.error_messages.invalid_type', self::DEFAULT_ERROR_MESSAGES['invalid_type'])
            ];
        }

        OTPModel::where('identifier', $identifier)->where('is_valid', true)->delete();

        $token = (new self)->generateToken();

        $validUntil = now()->addMinutes($validity);

        OTPModel::create([
            'identifier' => $identifier,
            'token' => $token,
            'valid_until' => $validUntil,
            'is_valid' => true
        ]);

        return (object)[
            'status' => true,
            'token' => $token,
            'message' => config('simplotp.success_messages.otp_generated', self::DEFAULT_SUCCESS_MESSAGES['otp_generated'])
        ];
    }

    /**
     * Validate an OTP.
     *
     * @param string $identifier The identifier associated with the OTP
     * @param string $token The OTP to validate
     * @return object Whether the OTP is valid or not
     */
    public static function validate(string $identifier, string $token): object
    {
        $data = OTPModel::where('identifier', $identifier)->where('token', $token)->first();

        if ($data instanceof OTPModel) {
            if ($data->is_valid) {
                $now = now();
                $validTime = $data->valid_until;

                $data->update(['is_valid' => false]);

                if (strtotime($validTime) < strtotime($now)) {
                    return (object)[
                        'status' => false,
                        'message' => config('simplotp.error_messages.expired_otp', self::DEFAULT_ERROR_MESSAGES['expired_otp'])
                    ];
                }

                $data->update(['is_valid' => false]);

                return (object)[
                    'status' => true,
                    'message' => config('simplotp.success_messages.otp_valid', self::DEFAULT_SUCCESS_MESSAGES['otp_valid'])
                ];
            }

            $data->update(['is_valid' => false]);

            return (object)[
                'status' => false,
                'message' => config('simplotp.error_messages.invalid_otp', self::DEFAULT_ERROR_MESSAGES['invalid_otp'])
            ];
        } else {
            return (object)[
                'status' => false,
                'message' => config('simplotp.error_messages.otp_not_found', self::DEFAULT_ERROR_MESSAGES['otp_not_found'])
            ];
        }
    }

    /**
     * Generate an OTP token.
     *
     * @return string The generated OTP token
     */
    private function generateToken(): string
    {
        // Get the OTP length and type from the config
        $length = config('simplotp.otp.length', 4);
        $type   = config('simplotp.otp.type', 'numeric');

        // Generate the OTP based on the specified type
        $otp = '';

        $characters = ($type === 'numeric') ? '0123456789' : '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[rand(0, $charactersLength - 1)];
        }

        return $otp;
    }
}