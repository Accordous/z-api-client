<?php

namespace Accordous\ZAPIClient\Services\Endpoints;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

abstract class Endpoint
{
    protected $http;

    public function __construct(PendingRequest $http)
    {
        $this->http = $http;
    }

    protected function client(): PendingRequest
    {
        return $this->http;
    }

    protected function validate(array $attributes): array
    {
        if (Config::get('z-api.test_phone')) {
            $attributes['phone'] = Config::get('z-api.test_phone');
        }

        return Validator::validate($attributes, $this->rules(), $this->messages(), $this->attributes());
    }

    abstract protected function rules(): array;

    abstract protected function messages(): array;

    abstract protected function attributes(): array;
}
