<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 */

namespace iPaya\Weibo\Api;


use yii\helpers\ArrayHelper;

class Statuses extends Api
{
    /**
     * 第三方分享链接到微博
     *
     * @see http://open.weibo.com/wiki/2/statuses/share
     * @param string $accessToken
     * @param string $text
     * 用户分享到微博的文本内容，必须做URLencode，内容不超过140个汉字，文本中不能包含“#话题词#”，
     * 同时文本中必须包含至少一个第三方分享到微博的网页URL，且该URL只能是该第三方（调用方）绑定域下的URL链接，
     * 绑定域在“我的应用 － 应用信息 － 基本应用信息编辑 － 安全域名”里设置。
     * @param string $pic
     * @param string|null $realIp
     * @return array|string
     */
    public function share(string $accessToken, string $text, string $pic = null, string $realIp = null)
    {
        $data = [
            'access_token' => $accessToken,
            'status' => $text,
            'rip' => $realIp,
        ];
        if ($pic) {
            $files = [
                'pic' => $pic,
            ];
            return $this->postWithFiles('statuses/share.json', $data, $files);
        } else {
            return $this->post('statuses/share.json', $data);
        }
    }

    /**
     * 获取当前登录用户及其所关注用户的最新微博
     *
     * @see http://open.weibo.com/wiki/2/statuses/home_timeline
     * @param string $accessToken
     * @param array $options
     * @return array|string
     */
    public function homeTimeline(string $accessToken, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
        ]);

        return $this->get('statuses/home_timeline.json', $queryParams);
    }

    /**
     * 获取用户发布的微博
     *
     * @see http://open.weibo.com/wiki/2/statuses/user_timeline
     * @param string $accessToken
     * @param array $options
     * @return array|string
     */
    public function userTimeline(string $accessToken, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
        ]);

        return $this->get('statuses/user_timeline.json', $queryParams);
    }

    /**
     * 返回一条原创微博的最新转发微博
     *
     * @see http://open.weibo.com/wiki/2/statuses/repost_timeline
     * @param string $accessToken
     * @param int $id
     * @param array $options
     * @return array|string
     */
    public function repostTimeline(string $accessToken, int $id, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
            'id' => $id,
        ]);

        return $this->get('statuses/repost_timeline.json', $queryParams);
    }

    /**
     * 获取@当前用户的最新微博
     *
     * @see http://open.weibo.com/wiki/2/statuses/mentions
     * @param string $accessToken
     * @param array $options
     * @return array|string
     */
    public function mentions(string $accessToken, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
        ]);

        return $this->get('statuses/mentions.json', $queryParams);
    }

    /**
     * 根据ID获取单条微博信息
     *
     * @see http://open.weibo.com/wiki/2/statuses/show
     * @param string $accessToken
     * @param int $id
     * @return array|string
     */
    public function show(string $accessToken, int $id)
    {
        $queryParams = [
            'access_token' => $accessToken,
            'id' => $id,
        ];

        return $this->get('statuses/show.json', $queryParams);
    }

    /**
     * 批量获取指定微博的转发数评论数
     *
     * @see http://open.weibo.com/wiki/2/statuses/count
     * @param string $accessToken
     * @param array $ids
     * @return array|string
     */
    public function count(string $accessToken, array $ids = [])
    {
        $queryParams = [
            'access_token' => $accessToken,
            'ids' => implode(',', $ids),
        ];

        return $this->get('statuses/count.json', $queryParams);
    }

    /**
     * 获取官方表情
     *
     * @see http://open.weibo.com/wiki/2/emotions
     * @param string $accessToken
     * @param string $type
     * @param string $language
     * @return array|string
     */
    public function emotions(string $accessToken, string $type = 'face', string $language = 'cnname')
    {
        $queryParams = [
            'access_token' => $accessToken,
            'type' => $type,
            'language' => $language,
        ];

        return $this->get('statuses/emotions.json', $queryParams);
    }


}
