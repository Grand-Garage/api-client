# api-client
A simple REST API client for laravel, supporting query parameters.

## Install
```composer require grandgarage/api-client```

## How to use

```
// Create request class 
$baseUrl = 'https://my-domain.com/api/v1/'; // example domain
$token = 'c4164ac9-703b-4e6b-a3cc-715a0e4dfe7d'; // example token
$request = new Grandgarage\ApiClient\HttpRequest($baseUrl, $token);

// GET request - example
 /** @var \Illuminate\Http\JsonResponse $response */
$respone = $request->get('users', [], 'orderBy=desc', 'limit=1000');

// POST request - example
$body = ['name' => 'Max Mustermann'];
$request->post('users', json_encode($body));

// UPDATE request - example
$id = 1;
$body = ['name' => 'Hilde Musterfrau'];
$request->put('users/'.$id, json_encode($body));
```
