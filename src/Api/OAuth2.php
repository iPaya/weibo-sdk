<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 */

namespace iPaya\Weibo\Api;


class OAuth2 extends Api
{
    /**
     * @param string|null $redirectUri
     * @param string|null $state
     * @param array $scope
     * @param bool $forceLogin 强制重新登录
     * @return string
     */
    public function getAuthorizeUrl(string $redirectUri = null, string $state = null, $scope = [], $forceLogin = false)
    {
        if (!is_array($scope)) {
            $scope = [$scope];
        }
        $client = $this->client;
        $queryParams = [
            'client_id' => $client->appKey,
            'redirect_uri' => $redirectUri ? $redirectUri : $client->redirectUri,
            'state' => $state,
            'scope' => implode(',', $scope),
            'forcelogin' => $forceLogin ? 'true' : 'false',
        ];
        return $client->oauth2BaseUrl . '/authorize?' . http_build_query($queryParams);
    }

    /**
     * @param string $code
     * @return array|string
     */
    public function getAccessToken(string $code)
    {
        $client = $this->client;
        $url = $client->oauth2BaseUrl . '/access_token';
        $data = [
            'client_id' => $client->appKey,
            'client_secret' => $client->appSecret,
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $client->redirectUri,
        ];
        return $this->post($url, $data);
    }

    /**
     * @param string $accessToken
     * @return array|string
     */
    public function getTokenInfo(string $accessToken)
    {
        $client = $this->client;
        $url = $client->oauth2BaseUrl . '/get_token_info';
        $data = [
            'access_token' => $accessToken,
        ];
        return $this->post($url, $data);
    }

    /**
     * @param string $accessToken
     * @return array|string
     */
    public function revokeOAuth2(string $accessToken)
    {
        $client = $this->client;
        $url = $client->oauth2BaseUrl . '/revokeoauth2';
        $data = [
            'access_token' => $accessToken,
        ];
        return $this->post($url, $data);
    }
}
