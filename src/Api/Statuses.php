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
