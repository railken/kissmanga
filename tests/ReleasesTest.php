<?php

use PHPUnit\Framework\TestCase;
use Railken\Kissmanga\Kissmanga;

class ReleasesTest extends TestCase
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

    public function testBasics()
    {
        $this->assertEquals(50, $this->manager->releases()->page(1)->get()->results->count());
    }
}
