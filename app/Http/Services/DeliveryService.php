<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

/**
 * DeliveryService
 * 
 * Class that defines logic for all deliveries
 */
abstract class DeliveryService
{
    private $url;
    private $data;

    abstract function validate($data);

    //Send request
    protected function send()
    {
        $guzzleClient = new Client();
        $response = $guzzleClient->request('POST', $this->url, $this->data);
        return $response;
    }

    protected function setUrl($url)
    {
        $this->data = $url;
    }

    protected function getUrl()
    {
        return $this->url;
    }

    protected function setData($data)
    {
        $this->data = $data;
    }

    protected function getData()
    {
        return $this->data;
    }

    //Checking what delivery is specified in the request
    static function checkDelivery($delivery)
    {
        if ($delivery == "novaposhta") {
            return new NovaPoshtaDelivery();
        } elseif ($delivery == "ukrposhta") {
            return new UkrPoshtaDelivery();
        } elseif ($delivery == "justin") {
            return new JustinDelivery();
        } else {
            throw new \InvalidArgumentException('Invalid delivery option ' . $delivery);
        }
    }
}
