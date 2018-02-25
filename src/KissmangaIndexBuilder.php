<?php

namespace Railken\Kissmanga;

use Railken\Kissmanga\Exceptions as Exceptions;
use Illuminate\Support\Collection;
use Railken\Bag;

class KissmangaIndexBuilder
{

    /**
     * @var Kissmanga
     */
    protected $manager;

    /**
     * Construct
     *
     * @param Kissmanga $manager
     */
    public function __construct(Kissmanga $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Send request
     *
     * @return Response
     */
    public function get()
    {
        $request = new KissmangaIndexRequest($this->manager);

        return $request->send($this);
    }
}
