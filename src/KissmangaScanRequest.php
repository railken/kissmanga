<?php

namespace Railken\Kissmanga;

use Illuminate\Support\Collection;
use Railken\Kissmanga\Exceptions as Exceptions;

class KissmangaScanRequest
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
     * Send the request for scans
     *
     * @param KissmangaScanBuilder $builder
     *
     * @return KissmangaScanResponse
     */
    public function send(KissmangaScanBuilder $builder)
    {
        
        $volume = $builder->getVolumeNumber() !== "-1" ? "/v{$builder->getVolumeNumber()}" : "";

        $chapter = "/c".str_pad($builder->getChapterNumber(), 3, '0', STR_PAD_LEFT);

        $url = "/roll_manga/{$builder->getMangaUid()}{$volume}{$chapter}";
        
        $results = $this->manager->requestMobile("GET", $url, []);
        
        $parser = new KissmangaScanParser($this->manager);

        return $parser->parse($results);
    }
}
