<?php

namespace App\Http\Services;

/**
 * JustinDelivery
 */
class JustinDelivery extends DeliveryService
{
    public function __construct()
    {
        $this->setUrl(env('JustinUrl'));
    }

    public function validate($data)
    {
        $data = [
            'name_customer' => $data['customer_name'],
            'phone_customer' => $data['phone'],
            'email_customer' => $data['email'],
            'delivery_address' => $data['delivery_address'],
            'package_width' => $data['width'],
            'package_length' => $data['length'],
            'package_height' => $data['height'],
            'package_weight' => $data['weight'],
        ];
        $validatedData['address_sender'] = env('Justin_sender_address');

        $this->setData($validatedData);
    }

    public function sendRequest()
    {
        return $this->send();
    }
}
