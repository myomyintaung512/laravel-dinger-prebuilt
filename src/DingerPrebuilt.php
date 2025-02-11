<?php

namespace myomyintaung512\LaravelDingerPrebuiltForm;

class DingerPrebuilt
{
    protected $apiKey;
    protected $merchantName;
    protected $merchantId;
    protected $baseUrl;
    protected $isProduction;

    public function __construct($config = [])
    {
        $this->apiKey = $config['api_key'] ?? null;
        $this->merchantName = $config['merchant_name'] ?? null;
        $this->merchantId = $config['merchant_id'] ?? null;
        $this->isProduction = $config['production'] ?? false;
        $this->baseUrl = $this->isProduction
            ? 'https://form.dinger.asia/api/'
            : 'https://prebuilt.dinger.asia/api/';
    }

    public function createPayment(array $data)
    {
        $payload = [
            'merchantName' => $this->merchantName,
            'merchantId' => $this->merchantId,
            'amount' => $data['amount'],
            'merchantOrderId' => $data['order_id'],
            'productDesc' => $data['description'] ?? '',
            'customerName' => $data['customer_name'] ?? '',
            'customerPhone' => $data['customer_phone'] ?? '',
            'customerEmail' => $data['customer_email'] ?? '',
            'items' => $data['items'] ?? [],
            'redirectUrl' => $data['redirect_url'] ?? '',
        ];

        return $this->makeRequest('POST', 'payment', $payload);
    }

    protected function makeRequest($method, $endpoint, $data = [])
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request($method, $this->baseUrl . $endpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);

        return json_decode($response->getBody(), true);
    }
}
