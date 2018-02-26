<?php

namespace Railken\Kissmanga\API\Resource;

use Illuminate\Support\Collection;
use Railken\Bag;
use Railken\Kissmanga\Kissmanga;

class Builder
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
        $request = new Request($this->manager);

        return $request->send($this);
    }
}
