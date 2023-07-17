<?php

namespace App\Http\Services\Delivery;

/**
 * UkrPoshtaDelivery
 */
class UkrPoshtaDelivery extends DeliveryService
{
    public function __construct()
    {
        $this->setUrl(env('UkrPoshtaUrl'));
    }

    public function validate($data)
    {
        $validatedData = [
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['phone'],
            'customer_email' => $data['email'],
            'delivery_address' => $data['delivery_address'],
            'width_package' => $data['width'],
            'length_package' => $data['length'],
            'height_package' => $data['height'],
            'weight_package' => $data['weight'],
        ];
        $validatedData['sender_address'] = env('UkrPoshta_sender_address');

        $this->setData($validatedData);
    }

    public function sendRequest()
    {
        return $this->send();
    }
}
