<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 */

namespace iPaya\Weibo;

use iPaya\Weibo\Api\Api;
use iPaya\Weibo\Api\OAuth2;


/**
 * Class Client
 * @package iPaya\Weibo
 */
class Client
{
    public $appKey;
    public $appSecret;
    public $redirectUri;

    /**
     * @var \GuzzleHttp\Client
     */
    public $httpClient;
    public $oauth2BaseUrl = 'https://api.weibo.com/oauth2';

    public $apiBaseUrl = 'https://api.weibo.com';
    public $apiVersion = 2;


    /**
     * @param string $name
     * @return Api|OAuth2
     */
    public function api(string $name)
    {

        switch ($name) {
            case 'oauth2':
                $api = new OAuth2($this);
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name));
        }
        return $api;
    }

    /**
     * @inheritDoc
     */
    public function __call($name, $arguments)
    {
        return $this->api($name);
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        if (!$this->httpClient) {
            $this->httpClient = new \GuzzleHttp\Client([
                'base_uri' => $this->apiBaseUrl . '/' . $this->apiVersion,
            ]);
        }
        return $this->httpClient;
    }

}
