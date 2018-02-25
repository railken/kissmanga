<?php

namespace Railken\Kissmanga;

use Railken\Kissmanga\Exceptions as Exceptions;
use Illuminate\Support\Collection;

class KissmangaReleasesBuilder
{

    /**
     * @var Kissmanga
     */
    protected $manager;

    /**
     * @var integer
     */
    protected $page = 1;

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
     * The page 
     *
     * @param string $page
     *
     * @return $this
     */
    public function page($page)
    {
        $this->page = $page;
        
        return $this;
    }

    /**
     * Return page
     *
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Send request
     *
     * @return Response
     */
    public function get()
    {
        $request = new KissmangaReleasesRequest($this->manager);

        return $request->send($this);
    }
}
