<?php

namespace Accordous\ZAPIClient\Services;

use Accordous\ZAPIClient\Services\Endpoints\InstanceEndpoint;
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
     * @var InstanceEndpoint
     */
    private $instance;

    /**
     * @var MessagesEndpoint
     */
    private $messages;

    /**
     * ZAPIService constructor.
     */
    public function __construct($instanceId = null, $instanceToken = null, $clientToken = null)
    {
        $instanceId = $instanceId ?? Config::get('z-api.instance_id');
        $instanceToken = $instanceToken ?? Config::get('z-api.instance_token');
        $clientToken = $clientToken ?? Config::get('z-api.client_token');

        $this->http = Http::withoutVerifying()
            ->baseUrl(Config::get('z-api.host') . "/instances/$instanceId/token/$instanceToken")
            ->withHeaders([
                'Cache-Control' => 'no-cache',
                'Client-Token' => $clientToken,
            ]);

        $this->instance = new InstanceEndpoint($this->http);
        $this->messages = new MessagesEndpoint($this->http);
    }

    /**
     * @return InstanceEndpoint
     */
    public function instance(): InstanceEndpoint
    {
        return $this->instance;
    }

    /**
     * @return MessagesEndpoint
     */
    public function messages(): MessagesEndpoint
    {
        return $this->messages;
    }
}
