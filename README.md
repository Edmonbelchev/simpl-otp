# SimplOtp

A Laravel package for simple OTP generation and validation with built-in Blade frontend scaffolding.

## Features

- Generate and validate OTPs
- Ready-to-use Blade views
- Email notification support
- Configurable settings
- Easy integration

## Quick Start

### Installation

```bash
composer require tech-ed/simpl-otp
php artisan migrate
```

### Basic Usage

```php
use TechEd\SimplOtp\SimplOtp;

// Generate OTP
$otp = SimplOtp::generate('user@example.com');

// Validate OTP
$result = SimplOtp::validate('user@example.com', '1234');
```

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --provider="TechEd\SimplOtp\SimplOtpServiceProvider" --tag="config"
```

Configure OTP settings in `config/simplotp.php`:

```php
return [
    'otp' => [
        'length' => 4,           // OTP length
        'type' => 'numeric',     // 'numeric' or 'alphanumeric'
        'validity' => 15,        // Validity in minutes
    ],
    'success_messages' => [
        'otp_generated' => 'OTP generated',
        'otp_valid' => 'OTP is valid',
    ],
    'error_messages' => [
        'expired_otp' => 'OTP Expired',
        'invalid_otp' => 'Invalid OTP',
        'otp_not_found' => 'OTP not found',
    ]
];
```

## Frontend Views

### Setup

```bash
php artisan simplotp:publish-frontend
```

### Routes

- Generate OTP: `/simplotp/generate`
- Verify OTP: `/simplotp/verify`

### Using in Your Controllers

```php
return view('simplotp::generate');
return view('simplotp::verify');
```

### Customization

The views are published to `resources/views/vendor/simplotp/` and include Bootstrap styling. You can customize them to match your application's design.

## Email Notifications

### Publish Email Template

```bash
php artisan vendor:publish --provider="TechEd\SimplOtp\SimplOtpServiceProvider" --tag="email"
```

### Send OTP via Email

```php
use TechEd\SimplOtp\SimplOtp;
use TechEd\SimplOtp\EmailOtpVerification;

$user = auth()->user();
$otp = SimplOtp::generate($user->email);

if ($otp->status === true) {
    $user->notify(new EmailOtpVerification($otp->token));
}
```

## Support

If SimplOtp has been helpful to you and you'd like to support its development, consider buying the developer a cup of coffee! ☕

Your support is greatly appreciated and helps in maintaining and improving SimplOtp for the Laravel community.

[!["Buy Me A Coffee"](https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png)](https://buymeacoffee.com/edmonbelchev)
