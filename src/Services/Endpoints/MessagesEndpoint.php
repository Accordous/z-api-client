<?php

namespace Accordous\ZAPIClient\Services\Endpoints;

class MessagesEndpoint extends Endpoint
{
    private const BASE_URI = '/send-text';

    /**
     * @param array $attributes
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function enviarTextoSimples(array $attributes)
    {
        return $this->client()->post(self::BASE_URI, $this->validate($attributes));
    }

    protected function rules(): array
    {
        return [
            'phone' => 'required|string',
            'message' => 'required|string',
            'delayMessage' => 'nullable|integer',
            'delayTyping' => 'nullable|integer',
        ];
    }

    protected function messages(): array
    {
        return [];
    }

    protected function attributes(): array
    {
        return [
            'phone' => 'Telefone',
            'message' => 'Texto a ser enviado',
            'delayMessage' => 'Delay da mensagem',
            'delayTyping' => 'Delay do status digitando',
        ];
    }
}
