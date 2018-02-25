<?php

use PHPUnit\Framework\TestCase;
use Railken\Kissmanga\Kissmanga;

use Railken\Kissmanga\Exceptions as Exceptions;

class DirectoryTest extends TestCase
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
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaDirectoryBuilderInvalidSortByValueException
     */
    public function testKissmangaDirectoryBuilderInvalidSortByValueException()
    {
        $this->manager->directory()->sortBy('wrong');
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaDirectoryBuilderInvalidBrowseByFilterException
     */
    public function testKissmangaDirectoryBuilderInvalidBrowseByFilterException()
    {
        $this->manager->directory()->browseBy('wrong', 'Action');
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaDirectoryBuilderInvalidBrowseByGenreValueException
     */
    public function testKissmangaDirectoryBuilderInvalidBrowseByGenreValueException()
    {
        $this->manager->directory()->browseBy('genre', 'wrong');
    }
    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaDirectoryBuilderInvalidBrowseByStatusValueException
     */
    public function testKissmangaDirectoryBuilderInvalidBrowseByStatusValueException()
    {
        $this->manager->directory()->browseBy('status', 'wrong');
    }
    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaDirectoryBuilderInvalidBrowseByReleasedYearValueException
     */
    public function testKissmangaDirectoryBuilderInvalidBrowseByReleasedYearValueException()
    {
        $this->manager->directory()->browseBy('released_year', 'wrong');
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaDirectoryBuilderInvalidBrowseByInitialValueException
     */
    public function testKissmangaDirectoryBuilderInvalidBrowseByInitialValueException()
    {
        $this->manager->directory()->browseBy('initial', 'wrong');
    }


    public function testBasics()
    {
        $results = $this->manager
            ->directory()
            ->browseBy('genre', 'Action')
            ->sortBy('name') 
            ->page(1)
            ->get();


    }
}