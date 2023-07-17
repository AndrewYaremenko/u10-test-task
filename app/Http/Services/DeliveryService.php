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
    /**
     * @var string The URL used for the delivery request.
     */
    private $url;
    /**
     * @var array The data used for the delivery request.
     */
    private $data;

    /**
     * Validates the provided data for the delivery.
     *
     * @param array $data The data to be validated.
     * @return void
     */
    abstract function validate($data);

    /**
     * Sends a POST request to the specified URL with the provided data.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory The response from the delivery request.
     */
    protected function send()
    {
        $guzzleClient = new Client();
        $response = $guzzleClient->request('POST', $this->url, $this->data);
        return $response;
    }

    /**
     * Sets the URL for the delivery request.
     *
     * @param string $url The URL to be set.
     * @return void
     */
    protected function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Gets the URL for the delivery request.
     *
     * @return string The URL for the delivery request.
     */
    protected function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the data for the delivery request.
     *
     * @param array $data The data to be set.
     * @return void
     */
    protected function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Gets the data for the delivery request.
     *
     * @return array The data for the delivery request.
     */
    protected function getData()
    {
        return $this->data;
    }

    /**
     * Creates and returns an instance of the specified delivery service based on the provided delivery option.
     *
     * @param string $delivery The delivery option.
     * @return DeliveryService An instance of the specified delivery service.
     * @throws \InvalidArgumentException When an invalid delivery option is provided.
     */
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
