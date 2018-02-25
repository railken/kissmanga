<?php

namespace Railken\Kissmanga;

use Illuminate\Support\Collection;

use Railken\Kissmanga\Exceptions as Exceptions;

class KissmangaResourceRequest
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
     * Send the request for the research
     *
     * @param KissmangaResourceBuilder $builder
     *
     * @return KissmangaResourceBuilder
     */
    public function send(KissmangaResourceBuilder $builder)
    {
        $results = $this->manager->request("GET", "/manga/{$builder->getUid()}", []);

        $parser = new KissmangaResourceParser($this->manager);

        try {
            return $parser->parse($results);
        } catch (Exceptions\KissmangaResourceParserInvalidUrlException $e) {
            throw new Exceptions\KissmangaResourceRequestNotFoundException($builder->getUid());
        }
    }
}
