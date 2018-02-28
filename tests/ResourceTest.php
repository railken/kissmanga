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
     * @expectedException Railken\Kissmanga\API\Resource\Exceptions\RequestNotFoundException
     */
    public function testKissmangaResourceRequestNotFoundException()
    {
        $manga = $this->manager->resource('wrong')->get();
    }

    public function testBasics()
    {
      
        $manga = $this->manager->resource('Fairy-Tail')->get();

        $this->assertEquals('Fairy Tail', $manga->name);
        // print_r($manga);
    }
}