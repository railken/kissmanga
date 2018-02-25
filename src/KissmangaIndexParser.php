<?php

namespace Railken\Kissmanga;

use \Wa72\HtmlPageDom\HtmlPageCrawler;
use Illuminate\Support\Collection;
use Railken\Bag;

class KissmangaIndexParser
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

        $bag->set('results', new Collection($node->filter('.series_preview')->each(function ($node) {
            $bag = new Bag();

            $title = $node;

            return $bag
                ->set('id', $title->attr('rel'))
                ->set('uid', basename($title->attr('href')))
                ->set('name', $title->html())
                ->set('url', "http:".$title->attr('href'))
                ;
        })));
        
        return $bag;
    }
	
}
