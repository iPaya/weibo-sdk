<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 */

namespace iPaya\Weibo\Api;


class Account extends Api
{
    /**
     * @param string $accessToken
     * @return array|string
     */
    public function getUid(string $accessToken)
    {
        return $this->get('account/get_uid.json', [
            'access_token' => $accessToken
        ]);
    }

    /**
     * @param string $accessToken
     * @return array|string
     */
    public function getRateLimitStatus(string $accessToken)
    {
        return $this->get('account/rate_limit_status.json', [
            'access_token' => $accessToken
        ]);
    }
}
