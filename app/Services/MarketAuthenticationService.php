<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;

class MarketAuthenticationService
{

    protected $baseUri;
    /**
     * @var \Illuminate\Config\Repository
     */
    private $clientId;
    /**
     * @var \Illuminate\Config\Repository
     */
    private $clientSecret;

    /**
     * @var \Illuminate\Config\Repository
     */

    private $passwordClientSecret;
    /**
     * @var \Illuminate\Config\Repository
     */
    private $passwordClientId;

    use ConsumesExternalServices,InteractsWithMarketResponses;

    public function __construct(){
        $this->baseUri = config('services.market.base_uri');
        $this->clientId = config('services.market.client_id');
        $this->clientSecret = config('services.market.client_secret');
        $this->passwordClientId = config('services.market.password_client_id');
        $this->passwordClientSecret = config('services.market.password_client_secret');
    }

    public function getClientCredentialsToken(){
        $formParams = [
            'grant_type' => 'client_credentials',
            'client_id' => intval($this->clientId),
            'client_secret' => $this->clientSecret
        ];

        $tokenData = $this->makeRequest('POST','oauth/token',[],$formParams);
        return "{$tokenData->token_type} {$tokenData->access_token}";
    }
}
