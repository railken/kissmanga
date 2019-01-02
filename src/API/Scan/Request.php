<?php

namespace Railken\Kissmanga\API\Scan;

use Railken\Kissmanga\Kissmanga;
use Wa72\HtmlPageDom\HtmlPageCrawler;

class Request
{
    /**
     * @var Kissmanga
     */
    protected $manager;

    /**
     * Constructor.
     *
     * @param Kissmanga $manager
     */
    public function __construct(Kissmanga $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Send the request for the research.
     *
     * @param Builder $builder
     *
     * @return Bag
     */
    public function send(Builder $builder)
    {
        $results = $this->manager->request('GET', "/Manga/{$builder->getMangaUid()}/a", ['id' => $builder->getChapterId()]);

        if (strpos(HtmlPageCrawler::create($results)->filter('title')->text(), 'Error') !== false) {
            throw new Exceptions\RequestNotFoundException($builder->getMangaUid());
        }

        $parser = new Parser($this->manager);

        return $parser->parse($results);
    }
}
