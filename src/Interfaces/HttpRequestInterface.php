<?php
namespace Grandgarage\ApiClient\Interfaces;

interface HttpRequestInterface
{
    /**
     *  Send a json GET request
     *
     * @param string $uri
     * @param array $headers
     * @param string ...$queryParams
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(string $uri, array $headers = [], string ...$queryParams): \Illuminate\Http\JsonResponse;

    /**
     * Send a POST request
     *
     * @param string $uri
     * @param string $jsonBody
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function post(string $uri, string $jsonBody, array $headers = []): \Illuminate\Http\JsonResponse;

    /**
     * Send a PUT request
     *
     * @param string $uri
     * @param string $jsonBody
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function put(string $uri, string $jsonBody, array $headers = []): \Illuminate\Http\JsonResponse;

    /**
     * Send a DELETE request
     *
     * @param string $uri Request URL
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(string $uri, array $headers = []): \Illuminate\Http\JsonResponse;
}
