<?php

namespace Railken\Kissmanga;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SetCookie;
use Symfony\Component\Cache\Simple\FilesystemCache;

abstract class KissmangaReader implements MangaReaderContract
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var \Symfony\Component\Cache\Simple\FilesystemCache
     */
    protected $cache;

    /**
     * @var string
     */
    protected $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36';

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->urls['app'], 'query_array_format' => 1]);
        $this->cache = new FilesystemCache('kissmanga.com', 3600);
    }

    /**
     * Send a request.
     *
     * @param string $method
     * @param string $url
     * @param array  $data
     */
    public function request($method, $url, $data, $retry = 2)
    {
        $params = [];
        $params['http_errors'] = false;

        $fullurl = $this->urls['app'].$url;

        $params['headers'] = [
            'User-Agent' => $this->agent,
        ];

        $cookies = $this->getCachedCookies();

        switch ($method) {
            case 'POST': case 'PUT':

                if (is_string($data)) {
                    $params['headers']['Content-Type'] = 'application/x-www-form-urlencoded';
                    $params['body'] = $data;
                } else {
                    $params['form_params'] = $data;
                }
            break;

            default:
                $params['query'] = $data;
            break;
        }

        $params['cookies'] = $cookies;

        $response = $this->client->request($method, $url, $params);
        $contents = $response->getBody()->getContents();

        if ($response->getStatusCode() === 502 && $retry > 0) {
            sleep(10);

            return $this->request($method, $url, $data, $retry - 1);
        }

        if ($response->getStatusCode() === 500 && $retry > 0) {
            sleep(30);

            return $this->request($method, $url, $data, $retry - 1);
        }

        if ($response->getStatusCode() === 200) {
            return $contents;
        }

        throw new \Exception($contents);
    }

    public function retrieveCookies()
    {
        $client = new Client([
            'base_uri'           => $this->urls['app'],
            'query_array_format' => 1,
            'headers'            => [
                'User-Agent' => $this->agent,
            ],
        ]);

        $client->getConfig('handler')->push(Middleware::create());

        $cookies = new \GuzzleHttp\Cookie\CookieJar();
        $cookies->setCookie(new SetCookie([
            'Domain'  => '.kissmanga.com',
            'Name'    => 'vns_readType1',
            'Value'   => 1,
            'Discard' => true,
        ]));

        $client->request('GET', '/', [
            'cookies' => $cookies,
        ]);

        return $cookies;
    }

    public function getCachedCookies()
    {
        if (!$this->cache->has('cookies')) {
            $this->cache->set('cookies', serialize($this->retrieveCookies()));
        }

        return unserialize($this->cache->get('cookies'));
    }

    /**
     * Send a request.
     *
     * @param string $method
     * @param string $url
     * @param array  $data
     */
    public function requestMobile($method, $url, $data)
    {
        return $this->request($method, $this->urls['mobile'].$url, $data);
    }

    public function getUserAgent()
    {
        return $this->agent;
    }
}
