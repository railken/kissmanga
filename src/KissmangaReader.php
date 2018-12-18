<?php

namespace Railken\Kissmanga;

use GuzzleHttp\Client;
use CloudflareBypass\CFBypass;
use GuzzleHttp\Cookie\CookieJar;
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
     * Constructor
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->urls['app'], 'query_array_format' => 1]);
        $this->cache = new FilesystemCache('kissmanga.com', 3600);
    }

    /**
     * Send a request
     *
     * @param string $method
     * @param string $url
     * @param array $data
     */
    public function request($method, $url, $data, $retry = 1)
    {
        $params = [];
        $params['http_errors'] = false;

        $fullurl = $this->urls['app'].$url;

        $params['headers'] = [
            'User-Agent' => $this->agent,
        ];

        $params['query_array_format'] = 1;

        // $params['debug'] = true;


        if (!$this->cache->has('cookies')) {
            $this->client->getConfig('handler')->push(Middleware::create());

            $cookies = new \GuzzleHttp\Cookie\CookieJar;
            $cookies->setCookie(new SetCookie([
                'Domain'  => '.kissmanga.com',
                'Name'    => 'vns_readType1',
                'Value'   => 1,
                'Discard' => true
            ]));

        } else {
            $cookies = unserialize($this->cache->get('cookies'));
        }
        

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

        $this->cache->set('cookies', serialize($cookies));
        

        if ($response->getStatusCode() == "502" and $retry > 0) {

            sleep(10);

            return $this->request($method, $url, $data, $retry-1);
        }



        if ($response->getStatusCode() != "200" and $retry > 0) {

            return $this->request($method, $url, $data, $retry-1);
        }
        
        return $contents;
    }

    /**
     * Send a request
     *
     * @param string $method
     * @param string $url
     * @param array $data
     */
    public function requestMobile($method, $url, $data)
    {
        return $this->request($method, $this->urls['mobile'].$url, $data);
    }
}
