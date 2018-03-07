<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 */

namespace iPaya\Weibo\src\Api;


use iPaya\Weibo\Api\Api;
use yii\helpers\ArrayHelper;

class Comments extends Api
{
    /**
     * 获取某条微博的评论列表
     *
     * @see http://open.weibo.com/wiki/2/comments/show
     * @param string $accessToken
     * @param int $id
     * @param array $options
     * @return array|string
     */
    public function show(string $accessToken, int $id, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
            'id' => $id,
        ]);

        return $this->get('comments/show.json', $queryParams);
    }

    /**
     * 我发出的评论列表
     *
     * @see http://open.weibo.com/wiki/2/comments/by_me
     * @param string $accessToken
     * @param array $options
     * @return array|string
     */
    public function byMe(string $accessToken, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
        ]);

        return $this->get('comments/by_me.json', $queryParams);
    }

    /**
     * 我收到的评论列表
     *
     * @see http://open.weibo.com/wiki/2/comments/to_me
     * @param string $accessToken
     * @param array $options
     * @return array|string
     */
    public function toMe(string $accessToken, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
        ]);

        return $this->get('comments/to_me.json', $queryParams);
    }

    /**
     * 获取用户发送及收到的评论列表
     *
     * @see http://open.weibo.com/wiki/2/comments/timeline
     * @param string $accessToken
     * @param array $options
     * @return array|string
     */
    public function timeline(string $accessToken, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
        ]);

        return $this->get('comments/timeline.json', $queryParams);
    }

    /**
     * 获取@到我的评论
     *
     * @see http://open.weibo.com/wiki/2/comments/mentions
     * @param string $accessToken
     * @param array $options
     * @return array|string
     */
    public function mentions(string $accessToken, array $options = [])
    {
        $queryParams = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
        ]);

        return $this->get('comments/mentions.json', $queryParams);
    }

    /**
     * 批量获取评论内容
     *
     * @see http://open.weibo.com/wiki/2/comments/show_batch
     * @param string $accessToken
     * @param array $cids
     * @return array|string
     */
    public function showBatch(string $accessToken, array $cids = [])
    {
        $queryParams = [
            'access_token' => $accessToken,
            'cids' => implode(',', $cids),
        ];

        return $this->get('comments/show_batch.json', $queryParams);
    }

    /**
     * 评论一条微博
     *
     * @see http://open.weibo.com/wiki/2/comments/create
     * @param string $accessToken
     * @param int $id
     * @param string $comment
     * @param bool $commentOriginal
     * @param string|null $rip
     * @return array|string
     */
    public function create(string $accessToken, int $id, string $comment, $commentOriginal = false, string $rip = null)
    {
        $data = [
            'access_token' => $accessToken,
            'comment' => $comment,
            'id' => $id,
            'comment_ori' => $commentOriginal ? 1 : 0,
            'rip' => $rip,
        ];

        return $this->post('comments/create.json', $data);
    }

    /**
     * 删除一条我的评论
     *
     * @see http://open.weibo.com/wiki/2/comments/destroy
     * @param string $accessToken
     * @param int $id
     * @return array|string
     */
    public function destroy(string $accessToken, int $id)
    {
        $data = [
            'access_token' => $accessToken,
            'cid' => $id,
        ];

        return $this->post('comments/destroy.json', $data);
    }

    /**
     * 批量删除我的评论
     *
     * @see http://open.weibo.com/wiki/2/comments/destroy_batch
     * @param string $accessToken
     * @param array $cids
     * @return array|string
     */
    public function destroyBatch(string $accessToken, array $cids = [])
    {
        $data = [
            'access_token' => $accessToken,
            'cids' => $cids,
        ];

        return $this->post('comments/destroy_batch.json', $data);
    }

    /**
     * 回复一条我收到的评论
     *
     * @see http://open.weibo.com/wiki/2/comments/reply
     * @param string $accessToken
     * @param int $id
     * @param int $cid
     * @param string $comment
     * @param array $options
     * @return array|string
     */
    public function reply(string $accessToken, int $id, int $cid, string $comment, array $options = [])
    {
        $data = ArrayHelper::merge($options, [
            'access_token' => $accessToken,
            'id' => $id,
            'cid' => $cid,
            'comment' => $comment,
        ]);

        return $this->post('comments/reply.json', $data);
    }
}
