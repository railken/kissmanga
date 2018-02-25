<?php

namespace Railken\Kissmanga;

use Railken\Kissmanga\Exceptions as Exceptions;
use Illuminate\Support\Collection;

class KissmangaResourceBuilder
{

    /**
     * @var Kissmanga
     */
    protected $manager;

    /**
     * @var string
     */
    protected $uid;

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
     * The uid 
     *
     * @param string $uid
     *
     * @return $this
     */
    public function uid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Return uid
     *
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Send request
     *
     * @return Response
     */
    public function get()
    {
        $request = new KissmangaResourceRequest($this->manager);

        return $request->send($this);
    }
}
