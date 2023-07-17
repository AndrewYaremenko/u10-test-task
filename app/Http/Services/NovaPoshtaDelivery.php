<?php

namespace App\Http\Services;

/**
 * NovaPoshtaDelivery
 */
class NovaPoshtaDelivery extends DeliveryService
{
    public function __construct()
    {
        $this->setUrl(env('NovaPoshtaUrl'));
    }

    public function validate($data)
    {
        $validatedData = [
            'customer_name' => $data['customer_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'delivery_address' => $data['delivery_address'],
            'width' => $data['width'],
            'length' => $data['length'],
            'height' => $data['height'],
            'weight' => $data['weight'],
        ];
        $validatedData['sender_address'] = env('NovaPoshta_sender_address');

        $this->setData($validatedData);
    }

    public function sendRequest()
    {
        return $this->send();
    }
}
