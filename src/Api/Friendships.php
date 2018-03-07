<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 */

namespace iPaya\Weibo\src\Api;


use iPaya\Weibo\Api\Api;
use yii\helpers\ArrayHelper;

class Friendships extends Api
{
    /**
     * 获取用户的关注列表
     *
     * @see http://open.weibo.com/wiki/2/friendships/friends
     * @param string $accessToken
     * @param array $options
     * @return array|string
     */
    public function friends(string $accessToken, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
        ]);

        return $this->get('friendships/friends.json', $queryParams);
    }

    /**
     * 获取用户关注对象UID列表
     *
     * @see http://open.weibo.com/wiki/2/friendships/friends/ids
     * @param string $accessToken
     * @param array $options
     * @return array|string
     */
    public function friendIds(string $accessToken, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
        ]);

        return $this->get('friendships/friends/ids.json', $queryParams);
    }

    /**
     * 获取用户粉丝列表
     *
     * @see http://open.weibo.com/wiki/2/friendships/followers
     * @param string $accessToken
     * @param array $options
     * @return array|string
     */
    public function followers(string $accessToken, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
        ]);

        return $this->get('friendships/followers.json', $queryParams);
    }

    /**
     * 获取用户粉丝UID列表
     *
     * @see http://open.weibo.com/wiki/2/friendships/followers/ids
     * @param string $accessToken
     * @param array $options
     * @return array|string
     */
    public function followerIds(string $accessToken, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
        ]);

        return $this->get('friendships/followers/ids.json', $queryParams);
    }

    /**
     * 获取两个用户之间是否存在关注关系
     *
     * @see http://open.weibo.com/wiki/2/friendships/show
     * @param string $accessToken
     * @param int $sourceId
     * @param int $targetId
     * @return array|string
     */
    public function show(string $accessToken, int $sourceId, int $targetId)
    {
        $queryParams = [
            'access_token' => $accessToken,
            'source_id' => $sourceId,
            'target_id' => $targetId,
        ];

        return $this->get('friendships/show.json', $queryParams);
    }
}
