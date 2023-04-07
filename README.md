# Z-API

Esse pacote auxilia no consumo da API do Z-API utilizando Laravel.

Documentação: [Z-API - Manual API](https://developer.z-api.io/).

## Instalação
```shell
composer require accordous/z-api-client
```

## Configuração

- Publique o arquivo de configuração caso tenha interesse em alterar algum dos valores pré-definidos
```shell
php artisan vendor:publish --tag=Z-API
```

- Altere as configurações no arquivo `.env` do seu projeto Laravel
```.dotenv
Z_API_HOST='https://api.z-api.io'
```

## Recursos
- Enviar texto simples `/send-text`

post
```php
use Accordous\ZAPIClient\Services\ZAPIService;

$service = new ZAPIService($instanciaId, $instanciaToken);

$attributes = [
    'phone' => '5511999999999',
    'message' => 'Welcome to *Z-API*',
];

$response = $service->messages()->enviarTextoSimples($attributes);

$result = $response->json();
```
