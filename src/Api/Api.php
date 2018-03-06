<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 */

namespace iPaya\Weibo\Api;


use iPaya\Weibo\Client;
use iPaya\Weibo\HttpClient\ResponseMediator;

abstract class Api
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @return array|string
     */
    public function get(string $path, array $parameters = [], array $headers = [])
    {
        $response = $this->client->getHttpClient()->get($path, [
            'query' => $parameters,
            'headers' => $headers,
        ]);

        return ResponseMediator::getContents($response);
    }

    /**
     * @param string $path
     * @param array $data
     * @param array $headers
     * @return array|string
     */
    public function post(string $path, array $data = [], array $headers = [])
    {
        $response = $this->client->getHttpClient()->post($path, [
            'form_params' => $data,
            'headers' => $headers,
        ]);

        return ResponseMediator::getContents($response);
    }

    /**
     * @param string $path
     * @param array $data
     * @param array $files
     * [
     *     'name'     => 'baz',
     *     'contents' => fopen('/path/to/file', 'r')
     * ]
     * @param array $headers
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function postWithFiles(string $path, array $data = [], array $files = [], array $headers = [])
    {
        $multipart = [];
        foreach ($data as $field => $value) {
            $multipart[] = [
                'name' => $field,
                'contents' => $value
            ];
        }
        foreach ($files as $field => $file) {
            $multipart[] = [
                'name' => $field,
                'contents' => fopen($file, 'r'),
            ];
        }
        return $this->client->getHttpClient()->post($path, [
            'headers' => $headers,
            'multipart' => $multipart
        ]);
    }

    /**
     * @param string $path
     * @param mixed $json
     * @param array $headers
     * @return array|string
     */
    public function postJson(string $path, $json, array $headers = [])
    {
        $response = $this->client->getHttpClient()->post($path, [
            'json' => $json,
            'headers' => $headers,
        ]);

        return ResponseMediator::getContents($response);
    }
}
