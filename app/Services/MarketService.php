<?php

namespace App\Services;


use App\Traits\AuthorizesMarketRequest;
use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;
use stdClass;

class MarketService
{
    use ConsumesExternalServices,AuthorizesMarketRequest,InteractsWithMarketResponses;

    protected $baseUri;

    public function __construct(){
        $this->baseUri = config('services.market.base_uri');
    }

    public function getProducts(){
        return $this->makeRequest('GET','products');
    }

    public function getCategories(){
        return $this->makeRequest('GET','categories');
    }
}
