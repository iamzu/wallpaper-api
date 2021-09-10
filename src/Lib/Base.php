<?php

namespace Lsoex\Wallpaper\Lib;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Lsoex\Wallpaper\Exceptions\HttpException;

class Base
{
    protected $guzzleOptions = [];

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return new Client($this->getGuzzleOption());
    }


    /**
     * @param $options
     */
    public function setGuzzleOptions($options)
    {
        $this->guzzleOptions = $options;
    }

    /**
     * @return array
     */
    protected function getGuzzleOption()
    {
        return $this->guzzleOptions;
    }

    /**
     * @param $url
     * @param $query
     * @param  string  $format
     * @throws HttpException
     * @return mixed|string
     */
    protected function send($url, $query, $format = 'json')
    {
        try {
            $response = $this->getHttpClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();
        } catch (GuzzleException $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }

        return 'json' === $format ? \json_decode($response, true) : $response;
    }
}
