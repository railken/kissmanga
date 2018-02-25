<?php

namespace Railken\Kissmanga;

use Illuminate\Support\Collection;

class KissmangaReleasesRequest
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
     * Send the request for the reReleases
     *
     * @param KissmangaReleasesBuilder $builder
     *
     * @return KissmangaReleasesResponse
     */
    public function send(KissmangaReleasesBuilder $builder)
    {   
        $results = $this->manager->request("GET", "/releases/{$builder->getPage()}.htm", []);

        $parser = new KissmangaReleasesParser($this->manager);

        return $parser->parse($results);
    }
}
