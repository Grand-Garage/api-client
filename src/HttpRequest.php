<?php

namespace Grandgarage\ApiClient;

use Grandgarage\ApiClient\Helpers\ApplicationHelper;
use Grandgarage\ApiClient\Interfaces\HttpRequestInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

/**
 * @see https://laravel.com/docs/9.x/http-client#introduction
 */
class HttpRequest implements HttpRequestInterface
{
    /** @var string the url of the REST API, e.g.: 'https://my-domain.com/api/v1/' */
    private string $baseUrl;

    /** @var string the bearer token for the api */
    private string $token;

    public function __construct(?string $baseUrl = null, ?string $token = null)
    {
        $this->baseUrl = $baseUrl ?: config('apiClient.base_url');
        $this->token = $token ?: config('apiClient.token');
    }

    /**
     *  Send a json GET request
     *
     * @param string $uri
     * @param array $headers
     * @param array $queryParams
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(string $uri, array $headers = [], string ...$queryParams): JsonResponse
    {
        $uri = $this->addQueryParams($uri, $queryParams);

        /** @var Response $response */
        $response = Http::baseUrl($this->baseUrl)
            ->withHeaders($headers)
            ->acceptJson()
            ->contentType('application/json')
            ->withToken($this->token)
            ->get($uri);

        return response()->json($response->json());
    }

    /**
     *  Send a json POST request
     *
     * @param string $uri
     * @param string $jsonBody
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function post(string $uri, string $jsonBody, array $headers = []): JsonResponse
    {
        /** @var Response $response */
        $response = Http::baseUrl($this->baseUrl)
            ->withHeaders($headers)
            ->acceptJson()
            ->contentType('application/json')
            ->withToken($this->token)
            ->withBody($jsonBody, 'application/json')
            ->post($uri);

        return response()->json($response->json());
    }

    /**
     * Send a json PUT request
     *
     * @param string $uri Request URL
     * @param string $jsonBody
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function put(string $uri, string $jsonBody, array $headers = []): JsonResponse
    {
        /** @var Response $response */
        $response = Http::baseUrl($this->baseUrl)
            ->withHeaders($headers)
            ->acceptJson()
            ->contentType('application/json')
            ->withToken($this->token)
            ->withBody($jsonBody, 'application/json')
            ->put($uri);

        return response()->json($response->json());
    }

    /**
     * Send a json DELETE request
     *
     * @param string $uri Request URL
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(string $uri, array $headers = []): JsonResponse
    {
        /** @var Response $response */
        $response = Http::baseUrl($this->baseUrl)
            ->withHeaders($headers)
            ->acceptJson()
            ->contentType('application/json')
            ->withToken($this->token)
            ->delete($uri);

        return response()->json($response->json());
    }

    /**
     * @param string $url
     * @param array $queryParams
     * @return string
     */
    private function addQueryParams(string $url, array $queryParams): string
    {
        $queryParams = array_filter($queryParams);
        if (ApplicationHelper::isEmpty($queryParams)) {
            return $url;
        }
        $url .= '?';
        $lastElement = end($queryParams);
        foreach ($queryParams as $param) {
            if ($param) {
                $url .= $param;
                if($param != $lastElement) {
                    $url .= '&';
                }
            }
        }
        return $url;
    }
}
