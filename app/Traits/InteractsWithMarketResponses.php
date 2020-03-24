<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use stdClass;

trait InteractsWithMarketResponses
{
    public function decodeResponse($response)  {
        $decodeResponse = json_decode($response);
        return $decodeResponse->data ?? $decodeResponse;
    }

    public function checkIfErrorResponse($response){
        if (isset($response->error)){
            throw new \Exception("Something failed: {$$response->error}");
        }
        return $response;
    }
}
