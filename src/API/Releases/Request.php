<?php

namespace Railken\Kissmanga\API\Releases;

use Railken\Kissmanga\Kissmanga;

class Request
{
    /*
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
     * @param KissmangaSearchBuilder $builder
     *
     * @return KissmangaSearchResponse
     */
    public function send(Builder $builder)
    {
        $results = $this->manager->request('GET', "/MangaList/LatestUpdate?page={$builder->getPage()}", []);

        $parser = new Parser($this->manager);

        return $parser->parse($results);
    }
}
