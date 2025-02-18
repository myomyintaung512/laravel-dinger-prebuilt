# Laravel Dinger

A Laravel package for integrating [Dinger](https://dinger.asia) payment gateway into your Laravel applications.

## Installation

You can install the package via composer:

```bash
composer require myomyintaung512/laravel-dinger-prebuilt
```

## Configuration

First publish the configuration file:

```bash
php artisan vendor:publish --provider="myomyintaung512\LaravelDingerPrebuilt\DingerServiceProvider"
```

Add the following configuration to your .env file:

```env
DINGER_CLIENT_ID=your_client_id
DINGER_MERCHANT_KEY=your_merchant_key
DINGER_PUBLIC_KEY=your_public_key
DINGER_PROJECT_NAME=your_project_name
DINGER_MERCHANT_NAME=your_merchant_name
DINGER_HASH_KEY=your_hash_key
DINGER_BASE_URL=https://prebuilt.dinger.asia
```

## Basic Usage

You can use the Dinger instance in two ways:

### Using Dependency Injection

```php
use myomyintaung512\LaravelDingerPrebuiltForm\DingerPrebuilt;

class PaymentController extends Controller
{
    public function checkout(DingerPrebuilt $dinger)
    {
        $items = [
            [
                'name' => 'Product 1',
                'amount' => 1000,
                'quantity' => 1
            ]
        ];

        $paymentUrl = $dinger->createPayment(
            $items,
            'Customer Name',
            1000,
            'ORDER_123'
        );

        return redirect($paymentUrl);
    }
}
```

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
