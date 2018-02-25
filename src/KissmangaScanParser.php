<?php

namespace Railken\Kissmanga;

use \Wa72\HtmlPageDom\HtmlPageCrawler;
use Illuminate\Support\Collection;
use Railken\Kissmanga\Exceptions as Exceptions;
use Railken\Bag;

class KissmangaScanParser
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
     * @return KissmangaScanResponse
     */
    public function parse($html)
    {
        $node = HtmlPageCrawler::create($html);

        return new Collection($node->filter("#viewer img")->each(function ($node) {
            $bag = new Bag();

            $bag->set('scan', $node->attr('data-original'));
            return $bag;
        }));

    }
}
