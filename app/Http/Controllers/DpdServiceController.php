<?php

namespace App\Http\Controllers;

use Artisaninweb\SoapWrapper\SoapWrapper;

class DpdServiceController extends Controller
{
    protected SoapWrapper $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }

    public function getServiceCost()
    {
        $this->soapWrapper->add('dpd', function ($service) {
            $service
                ->wsdl('https://ws.dpd.ru/services/calculator2?wsdl')
                ->trace(true)
                ->options([
                    'cache_wsdl' => WSDL_CACHE_NONE,
                ]);
        });
        $clientNumber = "1230000558";
        $clientKey = "620C35FB0624AACF16303286F7FC5C3DFD529C5A";
        $pickup = [
            'cityId' => 49694102,
            'cityName' => 'Moscow',
            'regionCode' => 77,
            'countryCode' => 'RU'
        ];
        $delivery = [
            'cityId' => 49265227,
            'index' => 140012,
            'cityName' => 'Chelyabinsk ',
            'regionCode' => 74,
            'countryCode' => 'RU',
        ];
        $parsel = [
            'weight' => 12,
            'length' => 12,
            'width' => 12,
            'height' => 12,
            'quantity' => 12
        ];
        $request = [
            'auth' => [
                'clientNumber' => $clientNumber,
                'clientKey' => $clientKey,
            ],
            'pickup' => $pickup,
            'delivery' => $delivery,
            'selfPickup'=> false,
            'selfDelivery'=>true,
            'serviceCode'=> 'BZP,ECN',
            'pickupDate' => 2014-05-21,
            'maxDays' => 2,
            'maxCost' => 1000,
            'declaredValue' => 1000,
            'parcel' => $parsel
        ];

        $response = $this->soapWrapper->call('dpd.getServiceCostByParcels2', [$request]);
        dd($response);
    }
}

