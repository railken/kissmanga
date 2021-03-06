<?php

namespace Railken\Kissmanga;

use CloudflareBypass\CFBypass;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tuna\CloudflareMiddleware;

class Middleware extends CloudflareMiddleware
{
    /**
     * Try to solve the JavaScript challenge.
     *
     * @param \Psr\Http\Message\RequestInterface  $request
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \GuzzleHttp\Psr7\Uri
     *
     * @throws \Exception
     */
    protected function solveJavascriptChallenge(RequestInterface $request, ResponseInterface $response)
    {
        $query = [];

        $uri = parse_url($request->getUri());

        if (isset($uri['query'])) {
            parse_str($uri['query'], $query);
        }

        $params = array_combine([
            'jschl_vc',
            'pass',
            'jschl_answer',
        ], CFBypass::bypass($response->getBody(), $request->getUri(), true));

        return new Uri(sprintf(
            '/cdn-cgi/l/chk_jschl?%s',
            http_build_query(array_merge($params, $query))
        ));
    }
}
