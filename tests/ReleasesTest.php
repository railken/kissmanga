<?php

use PHPUnit\Framework\TestCase;
use Railken\Kissmanga\Kissmanga;

use Railken\Kissmanga\Exceptions as Exceptions;

class ReleasesTest extends TestCase
{

    /**
     * @var Railken\Kissmanga\Kissmanga
     */
    private $manager;

    /**
     * Called on setup
     *
     * @return void
     */
    public function setUp()
    {
        $this->manager = new Kissmanga();
    }


    
    public function testBasics()
    {

        $results = $this->manager->releases()->page(1)->get();

    }
}