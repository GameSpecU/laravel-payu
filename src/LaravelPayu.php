<?php

namespace Gamespecu\LaravelPayu;

use Illuminate\Support\Facades\Request;
use Gamespecu\LaravelPayu\Models\PayuTransaction;

class LaravelPayu
{


    public function newTransaction($amount, $products, $orderId)
    {
        $order = [
            'notifyUrl' => 'http://edmed.krakow.pl/notify', //todo
            'customerIp' => Request::ip(),
            'merchantPosId' => \OpenPayU_Configuration::getMerchantPosId(),
            'description' => 'order#'.$orderId,
            'currencyCode' => 'PLN',
            'extOrderId' => (string)$orderId,
            'totalAmount' => (string)(int)($amount*100),
            'products' => $products,

        ];
        $response =  \OpenPayU_Order::create($order)->getResponse();
        $transaction = PayuTransaction::create(
            [
                'transaction_id' => $response->orderId,
                'destination' => $response->redirectUri,
                'body' => '',
            ]
        );
        return $transaction;
}}
