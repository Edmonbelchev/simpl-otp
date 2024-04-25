# SimplOtp

SimplOtp is a Laravel package that simplifies the generation and validation of one-time passwords (OTPs) in your Laravel applications.

This package is inspired by [ichtrojan/laravel-otp](https://github.com/ichtrojan/laravel-otp) but modified to be a little bit more flexible.

## Installation

You can install the SimplOtp package via Composer:

```bash
composer require tech-ed/simpl-otp
```

After installing the package, run the migration command to create the necessary database table:

```bash
php artisan migrate
```

The package will automatically register its service provider and facade.

## Configuration

To customize SimplOtp's behavior, you can publish its configuration file using the following artisan command:

```bash
php artisan vendor:publish --provider="TechEd\SimplOtp\SimplOtpServiceProvider" --tag="config"
```

This command will copy the configuration file `config/simplotp.php` to your application's `config` directory, where you can modify it according to your needs.

### Configuration Options

- **Success Messages**: Customize success messages for OTP generation and validation.
- **Error Messages**: Customize error messages for various failure scenarios.
- **OTP Settings**: Configure OTP length, type (numeric or alphanumeric), and validity period in minutes.

```php
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
```

## Usage

### Generating an OTP

You can generate an OTP using the `SimplOtp::generate()` method. It requires an identifier associated with the OTP.

```php
use TechEd\SimplOtp\SimplOtp;

$identifier = 'awesome@user.com';
$otp = SimplOtp::generate($identifier);
```

### Validating an OTP

To validate an OTP, use the `SimplOtp::validate()` method, passing the identifier and the OTP token.

```php
$identifier = 'awesome@user.com';
$token = '1234'; // OTP token to validate
$result = SimplOtp::validate($identifier, $token);
```

### Customization

You can customize success and error messages by editing the `config/simplotp.php` configuration file. Additionally, you can adjust OTP settings to suit your application's requirements.

### Generate Email Notification
To create a basic email template inside the Notifications folder, run the following artisan command:

```bash
php artisan vendor:publish --provider="TechEd\SimplOtp\SimplOtpServiceProvider" --tag="email"
```

This command allows you to customize the email notification template according to your specific requirements.

### Email Notification Example

To send an OTP via email, you can use Laravel's built-in notification system along with the provided `EmailOtpVerification` notification class.

```php
$user = auth()->user();
$otp = SimplOtp::generate($user->email);

if($otp->status === true){
    $user->notify(new EmailOtpVerification($otp->token));
}

return $otp;
```

This example generates an OTP for the authenticated user's email address and sends it via email using the EmailOtpVerification notification class.

## Support the developer
If SimplOtp has been helpful to you and you'd like to support its development, consider buying the developer a cup of coffee!

[!["Buy Me A Coffee"](https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png)](https://buymeacoffee.com/edmonbelchev)

Your support is greatly appreciated and helps in maintaining and improving SimplOtp for the Laravel community.

## License

The SimplOtp package is open-sourced software licensed under the [MIT license](LICENSE.md).
