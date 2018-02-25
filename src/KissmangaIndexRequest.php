<?php

namespace Railken\Kissmanga;

use Illuminate\Support\Collection;

class KissmangaIndexRequest
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
    public function __construct($manager)
    {
        $this->manager = $manager;
    }


    /**
     * Send the request
     *
     * @param KissmangaIndexBuilder $builder
     *
     * @return KissmangaIndexResponse
     */
    public function send(KissmangaIndexBuilder $builder)
    {

        $results = $this->manager->request("GET", "/manga/", []);

        $parser = new KissmangaIndexParser($this->manager);

        return $parser->parse($results);
    }
}
