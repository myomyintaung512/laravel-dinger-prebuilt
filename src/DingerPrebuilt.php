<?php

namespace myomyintaung512\LaravelDingerPrebuilt;

use phpseclib3\Crypt\RSA;
use phpseclib3\Crypt\PublicKeyLoader;

class DingerPrebuilt
{
    private $clientId;
    private $merchantKey;
    private $publicKey;
    private $projectName;
    private $merchantName;
    private $baseUrl;
    private $hashKey;

    public function __construct($config = [])
    {
        if (!isset($config['clientId'])) {
            throw new \InvalidArgumentException('clientId is required');
        }
        if (!isset($config['merchantKey'])) {
            throw new \InvalidArgumentException('merchantKey is required');
        }
        if (!isset($config['publicKey'])) {
            throw new \InvalidArgumentException('publicKey is required');
        }
        if (!isset($config['projectName'])) {
            throw new \InvalidArgumentException('projectName is required');
        }
        if (!isset($config['merchantName'])) {
            throw new \InvalidArgumentException('merchantName is required');
        }
        if (!isset($config['hashKey'])) {
            throw new \InvalidArgumentException('hashKey is required');
        }

        $this->clientId = $config['clientId'];
        $this->merchantKey = $config['merchantKey'];
        $this->publicKey = $config['publicKey'];
        $this->projectName = $config['projectName'];
        $this->merchantName = $config['merchantName'];
        $this->baseUrl = $config['baseUrl'] ?? 'https://prebuilt.dinger.asia';
        $this->hashKey = $config['hashKey'];
    }

    public function createPayment(array $data)
    {
        $items_data = array_map(function ($item) {
            return [
                "name" => $item['name'],
                "amount" => $item['amount'],
                "quantity" => $item['quantity']
            ];
        }, $data['items'] ?? []);

        $data_pay = json_encode([
            "clientId" => $this->clientId,
            "publicKey" => $this->publicKey,
            "items" => json_encode($items_data),
            "customerName" => $data['customer_name'] ?? '',
            "totalAmount" => $data['amount'],
            "merchantOrderId" => $data['order_id'],
            "merchantKey" => $this->merchantKey,
            "projectName" => $this->projectName,
            "merchantName" => $this->merchantName
        ]);

        $publicKey = '-----BEGIN PUBLIC KEY-----'
            . 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCFD4IL1suUt/TsJu6zScnvsEdL'
            . 'PuACgBdjX82QQf8NQlFHu2v/84dztaJEyljv3TGPuEgUftpC9OEOuEG29z7z1uOw'
            . '7c9T/luRhgRrkH7AwOj4U1+eK3T1R+8LVYATtPCkqAAiomkTU+aC5Y2vfMInZMgj'
            . 'X0DdKMctUur8tQtvkwIDAQAB'
            . '-----END PUBLIC KEY-----';

        $rsa = new RSA();
        $rsa->loadKey($publicKey);
        $rsa->setEncryptionMode(2);

        $ciphertext = $rsa->encrypt($data_pay);
        $value = base64_encode($ciphertext);
        $urlencode_value = urlencode($value);
        $encryptedHashValue = hash_hmac('sha256', $data_pay, $this->hashKey);


        $rsa = PublicKeyLoader::load($publicKey);
        $rsa = $rsa->withPadding(RSA::ENCRYPTION_PKCS1);

        $ciphertext = $rsa->encrypt($data_pay);
        $value = base64_encode($ciphertext);
        $urlencode_value = urlencode($value);

        $encryptedHashValue = hash_hmac('sha256', $data_pay, $this->hashKey);


        return $this->baseUrl . "/?hashValue=$encryptedHashValue&payload=$urlencode_value";
    }
}
