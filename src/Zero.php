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
        return $this->getCate('getAllCategories');
    }

    /**
     * @throws HttpException
     * @return mixed|string
     */
    public function getCategoriesV2()
    {
        return $this->getCate('getAllCategoriesV2');
    }

    /**
     * @param  int  $cid
     * @param  int  $start
     * @param  int  $count
     * @throws HttpException
     * @throws InvalidArgumentException
     * @return mixed|string
     */
    public function getAppsByCategory($cid, $start = 1, $count = 10)
    {
        $url = 'http://wallpaper.apc.360.cn/index.php';

        $cid = (int) ($cid);
        if ($cid <= 0) {
            throw new InvalidArgumentException('Invalid response cid: '.$count);
        }
        $count = (int) ($count);
        if ($count <= 0) {
            throw new InvalidArgumentException('Invalid response count: '.$count);
        }
        $start = (int) ($start);
        if ($start <= 0) {
            throw new InvalidArgumentException('Invalid response start: '.$start);
        }
        $query = [
            'c'     => 'WallPaper',
            'a'     => 'getAppsByCategory',
            'cid'   => $cid,
            'start' => $start,
            'count' => $count,
        ];
        return $this->send($url, $query);
    }

    /**
     * @param  int  $start
     * @param  int  $count
     * @throws HttpException
     * @throws InvalidArgumentException
     * @return mixed|string
     */
    public function getAppsByOrder($start = 1, $count = 10)
    {
        $url = 'http://wallpaper.apc.360.cn/index.php';
        $count = (int) ($count);
        if ($count <= 0) {
            throw new InvalidArgumentException('Invalid response count: '.$count);
        }
        $start = (int) ($start);
        if ($start <= 0) {
            throw new InvalidArgumentException('Invalid response start: '.$start);
        }
        $query = [
            'c'     => 'WallPaper',
            'a'     => 'getAppsByOrder',
            'order' => 'create_time',
            'start' => $start,
            'count' => $count,
        ];
        return $this->send($url, $query);
    }

    /**
     * @param $version
     * @throws HttpException
     * @return mixed|string
     */
    private function getCate($version)
    {
        $url = 'http://cdn.apc.360.cn/index.php';

        $query = [
            'c'    => 'WallPaper',
            'a'    => $version,
            'from' => '360chrome',
        ];
        return $this->send($url, $query);
    }


}
