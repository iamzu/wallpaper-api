<?php
/*
 * This file is part of the lsoex/wallpaper-api.
 *
 * (c) lsoex <i@lsoex.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Drizzle\Wallpaper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Drizzle\Wallpaper\Exceptions\HttpException;
use Drizzle\Wallpaper\Exceptions\InvalidArgumentException;
use Drizzle\Wallpaper\Lib\Base;

class Bing extends Base
{
    protected  $url = 'https://cn.bing.com/HPImageArchive.aspx';

    /**
     * @throws HttpException
     * @throws InvalidArgumentException
     */
    public function recentWallpapers($start = -1, $count = 1, $format = 'json')
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

        return $this->send($this->url,$query,$format);
    }

    /**
     * @param  string  $format
     * @throws HttpException
     * @throws InvalidArgumentException
     * @return mixed|string
     */
    public function todayWallpaper($format = 'json')
    {
        return $this->recentWallpapers(0, 1, $format);
    }
}
