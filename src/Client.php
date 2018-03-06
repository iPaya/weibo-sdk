<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 */

namespace iPaya\Weibo;

use iPaya\Weibo\Api\Account;
use iPaya\Weibo\Api\Api;
use iPaya\Weibo\Api\OAuth2;
use iPaya\Weibo\Api\Statuses;


/**
 * Class Client
 * @package iPaya\Weibo
 * @method OAuth2 oauth2()
 * @method Account account()
 * @method Statuses statuses()
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
    public $apiVersion = '2';


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
            case 'account':
                $api = new Account($this);
                break;
            case 'statuses':
                $api = new Statuses($this);
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
                'base_uri' => $this->getApiUrl(),
            ]);
        }
        return $this->httpClient;
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiBaseUrl . '/' . $this->apiVersion;
    }
}
