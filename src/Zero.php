<?php

namespace Lsoex\Wallpaper;

use GuzzleHttp\Exception\GuzzleException;
use Lsoex\Wallpaper\Exceptions\HttpException;
use Lsoex\Wallpaper\Exceptions\InvalidArgumentException;
use Lsoex\Wallpaper\Lib\Base;

class Zero extends Base
{
    /**
     * @throws HttpException
     * @return mixed|string
     */
    public function getCategories()
    {
        $url = 'http://wp.birdpaper.com.cn/intf/getCategory';
        return $this->send($url, []);
    }


    /**
     * @param  int  $cid
     * @param  int  $page
     * @param  int  $count
     * @throws HttpException
     * @throws InvalidArgumentException
     * @return mixed|string
     */
    public function getAppsByCategory($cid, $page = 1, $count = 10)
    {
        $url = 'http://wp.birdpaper.com.cn/intf/GetListByCategory';

        $cid = (int) ($cid);
        if ($cid <= 0) {
            throw new InvalidArgumentException('Invalid response cid: '.$count);
        }
        $count = (int) ($count);
        if ($count <= 0) {
            throw new InvalidArgumentException('Invalid response count: '.$count);
        }
        $page = (int) ($page);
        if ($page <= 0) {
            throw new InvalidArgumentException('Invalid response start: '.$page);
        }
        $query = [
            'cids'   => $cid,
            'pageno' => $page,
            'count'  => $count,
        ];
        return $this->send($url, $query);
    }

    /**
     * @param  int  $page
     * @param  int  $count
     * @throws HttpException
     * @throws InvalidArgumentException
     * @return mixed|string
     */
    public function getAppsNews($page = 1, $count = 10)
    {
        $url = 'http://wp.birdpaper.com.cn/intf/newestList';
        $count = (int) ($count);
        if ($count <= 0) {
            throw new InvalidArgumentException('Invalid response count: '.$count);
        }
        $page = (int) ($page);
        if ($page <= 0) {
            throw new InvalidArgumentException('Invalid response start: '.$page);
        }
        $query = [
            'pageno' => $page,
            'count'  => $count,
        ];
        return $this->send($url, $query);
    }

    /**
     * @param  string  $content
     * @param  int  $page
     * @param  int  $count
     * @throws HttpException
     * @throws InvalidArgumentException
     * @return mixed|string
     */
    public function search($content = '', $page = 1, $count = 10)
    {
        $url = 'http://wp.birdpaper.com.cn/intf/search';
        $count = (int) ($count);
        if ($count <= 0) {
            throw new InvalidArgumentException('Invalid response count: '.$count);
        }
        $page = (int) ($page);
        if ($page <= 0) {
            throw new InvalidArgumentException('Invalid response page: '.$page);
        }
        $content = trim($content);
        if (strlen($content) <= 0) {
            throw new InvalidArgumentException('Invalid response content: '.$content);
        }
        $query = [
            'content' => $content,
            'pageno'  => $page,
            'count'   => $count,
        ];
        return $this->send($url, $query);
    }

}
