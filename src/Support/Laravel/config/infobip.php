<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | Infobip supports a personalized base URL for API requests. By default,
    | each Infobip client has a different base URL which helps our platform
    | identify the originator of each API request.
    |
    | To see your base URL, log in to the Infobip API Resource hub with your
    | Infobip credentials. Once logged in, on all pages you should see your
    | base URL in this format: xxxxx.api.infobip.com.
    |
    | Documentation: https://www.infobip.com/docs/essentials/base-url
    |
    */

    'base_url' => env('INFOBIP_BASE_URL', 'https://xxxxx.api.infobip.com/'),

    /*
    |--------------------------------------------------------------------------
    | Timeout
    |--------------------------------------------------------------------------
    |
    | Float describing the total timeout of the request in seconds.
    | Use 0 to wait indefinitely (the default behavior).
    |
    */

    'timeout' => env('INFOBIP_TIMEOUT', 0),

    /*
    |--------------------------------------------------------------------------
    | API Key Header Authorization
    |--------------------------------------------------------------------------
    |
    | An API key is an access token that a client provides when making API
    | calls. It's a simple way to secure access and thus the most popular
    | authentication method used with REST APIs.
    |
    | You are automatically assigned an API Key once you create an account
    | on Infobip.
    |
    | Documentation: https://www.infobip.com/docs/essentials/api-authentication#api-key-header
    |
    */

    'api_key' => env('INFOBIP_API_KEY', 'api_key'),

];
