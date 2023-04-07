<?php

namespace Accordous\ZAPIClient\Services;

use Accordous\ZAPIClient\Services\Endpoints\MessagesEndpoint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class ZAPIService
{
    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    private $http;

    /**
     * @var MessagesEndpoint
     */
    private $messages;

    /**
     * ZAPIService constructor.
     */
    public function __construct($instanceId = null, $instanceToken = null)
    {
        $instanceId = $instanceId ?? Config::get('z-api.instance_id');
        $instanceToken = $instanceToken ?? Config::get('z-api.instance_token');

        $this->http = Http::withoutVerifying()
            ->baseUrl(Config::get('z-api.host') . "/instances/$instanceId/token/$instanceToken")
            ->withHeaders([
                'Cache-Control' => 'no-cache',
            ]);

        $this->messages = new MessagesEndpoint($this->http);
    }

    /**
     * @return MessagesEndpoint
     */
    public function messages(): MessagesEndpoint
    {
        return $this->messages;
    }
}
