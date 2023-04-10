<?php

namespace Accordous\ZAPIClient\Services\Endpoints;

class InstanceEndpoint extends Endpoint
{
    private const STATUS = '/status';
    private const RESTART = '/restart';

    /**
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function situacao()
    {
        return $this->client()->get(self::STATUS);
    }

    /**
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function reiniciar()
    {
        return $this->client()->get(self::RESTART);
    }

    protected function rules(): array
    {
        return [];
    }

    protected function messages(): array
    {
        return [];
    }

    protected function attributes(): array
    {
        return [];
    }
}
