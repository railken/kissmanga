<?php

use PHPUnit\Framework\TestCase;
use Railken\Kissmanga\Kissmanga;

class ScanTest extends TestCase
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
        $manga = $this->manager->resource('Fairy-Tail')->get();

        $chapter = $manga->volumes->first()->chapters[0];

        $this->manager->scan($manga->uid, $chapter->id)->get()->each(function ($scan) {
            $this->assertEquals(true, strpos($scan->scan, 'http') !== false);
        });
    }
}
