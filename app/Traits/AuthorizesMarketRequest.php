<?php

namespace App\Traits;

use App\Services\MarketAuthenticationService;

trait AuthorizesMarketRequest
{
    public function resolveAuthorization(&$queryParams,&$formParams,&$headers) :void{
        $accessToken = $this->resolveAccessToken();
        $headers['Authorization'] = $accessToken;
    }

    public function resolveAccessToken() :string {
        $authenticationService = resolve(MarketAuthenticationService::class);
        return $authenticationService->getClientCredentialsToken();
    }
}
