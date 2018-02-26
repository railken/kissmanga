<?php

namespace Railken\Kissmanga;

use GuzzleHttp\Client;
use KyranRana\CloudflareBypass\RequestMethod\CFStream;
use KyranRana\CloudflareBypass\RequestMethod\CFCurl;
use GuzzleHttp\Cookie\CookieJar;

abstract class KissmangaReader implements MangaReaderContract
{

    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->urls['app'], 'query_array_format' => 1]);
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
        
        $stream_cf_wrapper = new CFStream([
            'cache'         => true,
            'max_attempts'  => 5
        ]);

        $agent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36";


        $stream = $stream_cf_wrapper->create($fullurl, [
            'http' => [
                'method' => "GET",
                'header' => "User-Agent:$agent"
            ]
        ]);

        $params['headers'] = [
            'User-Agent' => "$agent",
        ];

        $params['query_array_format'] = 1;
        $params['cookies'] = CookieJar::fromArray($stream->getCookiesOriginal(), parse_url($this->urls['app'])['host']);

        // $params['debug'] = true;

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

        $response = $this->client->request($method, $url, $params);

        $contents = $response->getBody()->getContents();


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
