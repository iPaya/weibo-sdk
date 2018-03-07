<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 */

namespace iPaya\Weibo\src\Api;


use iPaya\Weibo\Api\Api;

class Users extends Api
{
    /**
     * 获取用户信息
     *
     * @see http://open.weibo.com/wiki/2/users/show
     * @param string $accessToken
     * @param int|null $uid
     * @param string|null $name
     * @return array|string
     */
    public function show(string $accessToken, int $uid = null, string $name = null)
    {
        $queryParams = [
            'access_token' => $accessToken,
            'uid' => $uid,
            'screen_name' => $name,
        ];

        return $this->get('users/show.json', $queryParams);
    }

    /**
     * 通过个性域名获取用户信息
     *
     * @see http://open.weibo.com/wiki/2/users/domain_show
     * @param string $accessToken
     * @param string $domain
     * @return array|string
     */
    public function domainShow(string $accessToken, string $domain)
    {
        $queryParams = [
            'access_token' => $accessToken,
            'domain' => $domain,
        ];

        return $this->get('users/domain_show.json', $queryParams);
    }

    /**
     * 批量获取用户的粉丝数、关注数、微博数
     *
     * @see http://open.weibo.com/wiki/2/users/counts
     * @param string $accessToken
     * @param array $uids
     * @return array|string
     */
    public function counts(string $accessToken, array $uids = [])
    {
        $queryParams = [
            'access_token' => $accessToken,
            'uids' => implode(',', $uids),
        ];

        return $this->get('users/domain_show.json', $queryParams);
    }
}
