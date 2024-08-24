# SimplOtp

A simple OTP (One-Time Password) package for Laravel applications.

## Installation

You can install the package via composer:

```bash
composer require teched/simplotp
```

## Usage

### Backend

Generate an OTP:

```php
use TechEd\SimplOtp\SimplOtp;

$result = SimplOtp::generate('user@example.com');
```

Validate an OTP:

```php
use TechEd\SimplOtp\SimplOtp;

$result = SimplOtp::validate('user@example.com', '1234');
```

### Frontend Scaffolding

This package now includes Blade views for OTP generation and verification.

1. Publish the frontend files:

```bash
php artisan simplotp:publish-frontend
```

2. The package automatically registers the necessary routes. You can access the OTP generation and verification forms at:

   - Generate OTP: `/simplotp/generate`
   - Verify OTP: `/simplotp/verify`

3. If you want to customize the views, you can find them in `resources/views/vendor/simplotp/`.

4. To use the views in your own controllers or routes, you can use:

```php
return view('simplotp::generate');
return view('simplotp::verify');
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="TechEd\SimplOtp\SimplOtpServiceProvider" --tag="config"
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.