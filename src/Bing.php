<?php
/*
 * This file is part of the lsoex/wallpaper.
 *
 * (c) lsoex <i@lsoex.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Lsoex\Wallpaper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Lsoex\Wallpaper\Exceptions\HttpException;
use Lsoex\Wallpaper\Exceptions\InvalidArgumentException;

class Bing
{
    protected string $url = 'https://cn.bing.com/HPImageArchive.aspx';

    protected array $guzzleOptions = [];

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    /**
     * @param $options
     */
    public function setGuzzleOptions($options)
    {
        $this->guzzleOptions = $options;
    }

    /**
     * @throws HttpException
     * @throws InvalidArgumentException
     */
    public function getBing($start = 0, $count = 1, $format = 'json')
    {
        $format = \strtolower($format);
        if (!\in_array(($format), ['xml', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: '.$format);
        }
        $format = $format === 'json' ? 'js' : $format;

        $count = (int) ($count);
        if ($count <= 0) {
            throw new InvalidArgumentException('Invalid response n: '.$count);
        }
        $start = (int) ($start);
        if ($start < -1) {
            throw new InvalidArgumentException('Invalid response idx: '.$start);
        }
        //0今天  -1 截止至明天（预准备的） 1 截止至昨天，类推（目前最多获取到16天前的图片
        $start = $start > 16 ? 16 : $start;
        //1-8 返回请求数量，目前最多一次获取8张
        $count = $count > 8 ? 8 : $count;

        $query = [
            'idx'    => $start,
            'n'      => $count,
            'format' => $format,
        ];

        try {
            $response = $this->getHttpClient()->get($this->url, [
                'query' => $query,
            ])->getBody()->getContents();
        } catch (GuzzleException $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }

        return 'json' === $format ? \json_decode($response, true) : $response;
    }

    /**
     * @param  string  $format
     * @throws HttpException
     * @throws InvalidArgumentException
     * @return mixed|string
     */
    public function getLive($format = 'json')
    {
        return $this->getBing(0, 1, $format);
    }
}
