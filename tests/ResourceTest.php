<?php

use PHPUnit\Framework\TestCase;
use Railken\Kissmanga\Kissmanga;

class ResourceTest extends TestCase
{
    /**
     * @var Railken\Kissmanga\Kissmanga
     */
    private $manager;

    /**
     * Called on setup.
     */
    public function setUp()
    {
        $this->manager = new Kissmanga();
    }

    /**
     * @expectedException \Railken\Kissmanga\API\Resource\Exceptions\RequestNotFoundException
     */
    public function testKissmangaResourceRequestNotFoundException()
    {
        $manga = $this->manager->resource('wrong')->get();
    }

    public function testBasics()
    {
        $manga = $this->manager->resource('Overlord')->get();

        $this->assertEquals('Overlord', $manga->name);
        $this->assertEquals('Overlord', $manga->uid);
    }
}
