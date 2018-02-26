<?php

namespace Railken\Kissmanga\API\Resource;

use Illuminate\Support\Collection;

use Railken\Kissmanga\Kissmanga;

class Request
{
    
    /**
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
     * Send the request for the research
     *
     * @param Builder $builder
     *
     * @return Bag
     */
    public function send(Builder $builder)
    {
        $results = $this->manager->request("GET", "/Manga/{$builder->getUid()}", []);

        $parser = new Parser($this->manager);

        return $parser->parse($results);
    }
}
