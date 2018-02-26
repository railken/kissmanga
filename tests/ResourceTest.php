<?php

use PHPUnit\Framework\TestCase;
use Railken\Kissmanga\Kissmanga;

use Railken\Kissmanga\Exceptions as Exceptions;

class ResourceTest extends TestCase
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

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaResourceRequestNotFoundException
     */
    public function testKissmangaResourceRequestNotFoundException()
    {
        $manga = $this->manager->resource('wrong')->get();
    }

    public function testBasics()
    {
      
        $manga = $this->manager->resource('fairy-tail')->get();

        $this->assertEquals('fairy-tail', $manga->uid);


    }
}