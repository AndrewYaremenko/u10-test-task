<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Services\DeliveryService;

/**
 * DeliveryController
 *
 * Controller class for managing delivery orders.
 */
class DeliveryController extends Controller
{
    /**
     * order
     *
     * Handles the order request for delivery.
     *
     * @param  Request $request The HTTP request object.
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory The response object or factory.
     */
    public function order(Request $request)
    {
        //Form data validation
        $data = $request->validate([
            'customer_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'delivery_address' => ['required', 'string'],
            'width' => ['required', 'string'],
            'length' => ['required', 'string'],
            'height' => ['required', 'string'],
            'weight' => ['required', 'string'],
        ]);

        //Checking what delivery is specified in the request
        $deliveryService = DeliveryService::checkDelivery($request->delivery);
        //Carry out validation depending on the delivery body fields
        $deliveryService->validate($data);
        //Send request
        dd($deliveryService);
        $status = $deliveryService->sendRequest()->getStatus();

        return response()->json('', $status);
    }
}
