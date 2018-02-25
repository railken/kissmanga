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

        print_r($html);
        $bag->set('results', new Collection($node->filter('.listing > tr')->each(function ($node) {
            $bag = new Bag();

            $title = $node->filter("a.title");

            return $bag
                ->set('uid', basename($title->attr('href')))
                ->set('name', $title->html())
                ->set('status',  $node->filter('td')[1]->html())
                ;
        })));
        


        return $bag;

        // print_r($results);
        // $response = new KissmangaSearchResponse();
    }
}
