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

        $main = $node->filter('body .barContent:nth-of-type(2)');
        $head = $node->filter("head");

        $name = $node->filter("a.bigChar:nth-child(1)")->html();
        
        $bag = new Bag();
        $bag
            ->set('name', $name)
            ->set('uid', $node->filter("a.bigChar:nth-child(1)")->html())
            ->set('aliases', $main->filter("p:nth-of-type(1) > a")->each(function($node) { return $node->text(); }))
            ->set('genres', $main->filter("p:nth-of-type(2) > a")->each(function($node) { return $node->text(); }))
            ->set('author', $node->filter("p:nth-of-type(3) > a")->html())
            ->set('cover', $head->filter("[rel='image_src']")->attr('href'))
            ->set('status', strpos($main->filter("p:nth-of-type(4)")->text(), 'Ongoing') !== false ? 'Ongoing' : 'Completed')
            ->set('volumes', (new Bag())->set('volume', -1)->set('chapters', (new Collection($node->filter('.listing > tr')->each(function ($node) use ($name) {
                
                $bag = new Bag();

                $title = $node->filter('a:nth-child(1)');

                if (count($title) === 0)
                    return null;


                $number = preg_replace("/Read|$name|online|Chapter|\s/", "", $title->attr('title'));

                return $bag
                    ->set('url', $title->attr('href'))
                    ->set('number', $number) // title="Read One Piece Chapter 895: Pirate Luffy vs. Sweet Commander Katakuri online
                    ->set('title', trim(preg_replace("/&nbsp;/", " ", $title->html())))
                    ->set('released_at', trim($node->filter('td:nth-of-type(2)')->text()))
                ;

            })))->filter(function($v) { return $v; })->values()))
        ;
        return $bag;

        // print_r($results);
        // $response = new KissmangaSearchResponse();
    }
}
