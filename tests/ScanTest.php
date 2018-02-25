<?php

use PHPUnit\Framework\TestCase;
use Railken\Kissmanga\Kissmanga;

use Railken\Kissmanga\Exceptions as Exceptions;

class ScanTest extends TestCase
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

        $manga = $this->manager->resource('fairy_tail')->get();


        $chapter = $manga->volumes->first()->chapters[0];

        $this->manager->scan($manga->uid, $chapter->volume, $chapter->number)->get()->each(function($scan) {
            file_get_contents($scan->scan);
        });



    }
}