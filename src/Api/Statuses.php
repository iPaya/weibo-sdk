<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 */

namespace iPaya\Weibo\Api;


class Statuses extends Api
{
    /**
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
}
