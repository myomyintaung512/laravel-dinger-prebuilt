# Laravel Dinger

A Laravel package for integrating [Dinger](https://dinger.asia) payment gateway into your Laravel applications.

## Installation

You can install the package via composer:

```bash
composer require myomyintaung512/laravel-dinger
```

## Configuration

Add the following configuration to your .env file:

```env
DINGER_API_KEY=your_api_key
DINGER_MERCHANT_NAME=your_merchant_name
DINGER_MERCHANT_ID=your_merchant_id
DINGER_PRODUCTION=false
```

## Basic Usage

```php
use myomyintaung512\LaravelDinger\Dinger;

$dinger = new Dinger([
    'api_key' => env('DINGER_API_KEY'),
    'merchant_name' => env('DINGER_MERCHANT_NAME'),
    'merchant_id' => env('DINGER_MERCHANT_ID'),
    'production' => env('DINGER_PRODUCTION', false),
]);

$payment = $dinger->createPayment([
    'amount' => 1000,
    'order_id' => 'ORDER_123',
    'description' => 'Product purchase',
    'customer_name' => 'Mg Mg',
    'customer_phone' => '09123456789',
    'customer_email' => 'mgmg@example.com',
    'redirect_url' => 'https://your-website.com/payment/callback'
]);
```

## Environment

- Production URL: https://form.dinger.asia
- Staging URL: https://prebuilt.dinger.asia

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
