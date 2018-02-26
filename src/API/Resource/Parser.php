<?php

namespace Railken\Kissmanga\API\Resource;

use \Wa72\HtmlPageDom\HtmlPageCrawler;
use Illuminate\Support\Collection;
use Railken\Bag;
use Railken\Kissmanga\Kissmanga;

class Parser
{
    
    /*
     * @var Kissmanga
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param Kissmanga $manager
     */
    public function __construct(Kissmanga $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Parse the response
     *
     * @return string $html
     *
     * @return KissmangaSearchResponse
     */
    public function parse($html)
    {
        $node = HtmlPageCrawler::create($html);

        $bag = new Bag();
        $bag
            ->set('name', $node->filter("a.bigChar:nth-child(1)")->html())
            ->set('uid', $node->filter("a.bigChar:nth-child(1)")->html())
        ;
        return $bag;

        // print_r($results);
        // $response = new KissmangaSearchResponse();
    }
}
