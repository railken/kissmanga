<?php

namespace Railken\Kissmanga\API\Releases;

use Railken\Kissmanga\Kissmanga;

class Builder
{
    /**
     * @var Kissmanga
     */
    protected $manager;

    /**
     * @var int
     */
    protected $page = 1;

    /**
     * Construct.
     *
     * @param Kissmanga $manager
     */
    public function __construct(Kissmanga $manager)
    {
        $this->manager = $manager;
    }

    /**
     * The page.
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
     * Return page.
     *
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Send request.
     *
     * @return Response
     */
    public function get()
    {
        $request = new Request($this->manager);

        return $request->send($this);
    }
}
