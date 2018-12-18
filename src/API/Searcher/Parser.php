<?php

namespace Railken\Kissmanga\API\Searcher;

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

        $bag->set('results', (new Collection($node->filter('.listing > tr')->each(function ($node) {
            $bag = new Bag();

            $title = $node->filter('a:nth-child(1)');

            if (count($title) === 0) {
                return null;
            }

            return $bag
                ->set('uid', basename($title->attr('href')))
                ->set('name', trim($title->html()))
            ;
        })))->filter(function ($v) {
            return $v;
        })->values());
        


        return $bag;

        // print_r($results);
        // $response = new KissmangaSearchResponse();
    }
}
