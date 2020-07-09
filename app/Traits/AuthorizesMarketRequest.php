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
        /**
         * para revision en la automatizacion
         */
        $authenticationService = resolve(MarketAuthenticationService::class);

        if (auth()->user()) {
            return $authenticationService->getAuthenticatedUserToken();
        }
        return $authenticationService->getClientCredentialsToken();
        //return 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjAxZjBmOWVkMzYyMWY2YWYyMmU2NmNiOGZjMGMxNDZhNWZiY2ZmNzAzZTBlODlkN2IwYTBiNzlmNWIzNmFkY2ZlMTBmYjE1M2NlYjY4ZGExIn0.eyJhdWQiOiIyIiwianRpIjoiMDFmMGY5ZWQzNjIxZjZhZjIyZTY2Y2I4ZmMwYzE0NmE1ZmJjZmY3MDNlMGU4OWQ3YjBhMGI3OWY1YjM2YWRjZmUxMGZiMTUzY2ViNjhkYTEiLCJpYXQiOjE1NzgwOTg4MDYsIm5iZiI6MTU3ODA5ODgwNiwiZXhwIjoxNjA5NzIxMjA2LCJzdWIiOiIxMTk3Iiwic2NvcGVzIjpbInB1cmNoYXNlLXByb2R1Y3QiLCJtYW5hZ2UtYWNjb3VudCIsIm1hbmFnZS1wcm9kdWN0cyIsInJlYWQtZ2VuZXJhbCJdfQ.V5YfBIXmmyrF7R1x__XtFcw9ftHUo-OONcoeK24y54OUSHBq-FZWq5E1kRKH4-fbPgcR9G6ntwlydniuLY795oIiHLiD_R3XPI8xboo3HNSA6wFyDYP7q4lAqMuSOwCUPqzTXpd0J6SLMHmG8lWpft5hq8n9jRjkyF7Fi_ogxdmqwszb1EBRwGLLnYEEXau194g-gNDzQoGhSIRaIdmiRygZOujvgwCEALKEWPPykhaDTFm3av5S3sZQsB2wjvhH2Wx1AL_L5sBWwCFyYIYFn29v7P_snaPbfbEcRrVSsE1qCI7tx4zFUFrTaNKy5crxMK0Pl-fc37Cb1pvC2UmeH5I_2NS8Rgvs1N3JcQK-GJ_ps93Q0j0Hegyi1KqdY9uixRSfS1glPCmb2u5q8gDc6IoLzbzwhE6bdpl7ScZWDwz2EQPPOV2TwrO6zxKehQ8VvtJwv_w7QuujH0MlBgsXMyjWHr2hAhUKQdtL5A-w24gs8Mv7NXkomezyuKfkhVRI5paWQ7b2nEvMJojQw8RiDdmqw4YDdmISrVItBYyqXTUA4r1BjO1aeLfpTI6v5ifxQSAqp7YsozRc088tx4Vp2eWLKElJAJ-wb0W3AwjONp8_VpwP0QpKIxujzcO-v-EbALfV5b6wJf9YT0HvjIemxsjg-fsY3rdOcL8pqaayAYs';
    }
}
