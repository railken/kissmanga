<?php

use PHPUnit\Framework\TestCase;
use Railken\Kissmanga\Kissmanga;

use Railken\Kissmanga\Exceptions as Exceptions;

class SearchTest extends TestCase
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
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidTypeException
     */
    public function testKissmangaSearchBuilderInvalidTypeException()
    {
        $this->manager->search()->type('wrong');
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidNameFilterException
     */
    public function testKissmangaSearchBuilderInvalidNameFilterException()
    {
        $this->manager->search()->name('wrong', 'One Piece');
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidAuthorFilterException
     */
    public function testKissmangaSearchBuilderInvalidAuthorFilterException2()
    {
        $this->manager->search()->author('wrong', 'Oda Eiichiro');
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidArtistFilterException
     */
    public function testKissmangaSearchBuilderInvalidArtistFilterException3()
    {
        $this->manager->search()->artist('wrong', 'Oda Eiichiro');
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidGenresFilterException
     */
    public function testKissmangaSearchBuilderInvalidGenresFilterException()
    {
        $this->manager->search()->genres('wrong', ['Action']);
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidGenresValueException
     */
    public function testKissmangaSearchBuilderInvalidGenresValueException()
    {
        $this->manager->search()->genres('include', ['Food']);
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidSortByDirectionException
     */
    public function testKissmangaSearchBuilderInvalidSortByDirectionException()
    {
        $this->manager->search()->sortBy('name', 'wrong');
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidSortByValueException
     */
    public function testKissmangaSearchBuilderInvalidSortByValueException()
    {
        $this->manager->search()->sortBy('wrong', 'asc');
    }


    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidReleasedYearFilterException
     */
    public function testKissmangaSearchBuilderInvalidReleasedYearFilterException()
    {
        $this->manager->search()->releasedYear('wrong', '2017');
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidReleasedYearValueException
     */
    public function testKissmangaSearchBuilderInvalidReleasedYearValueException()
    {
        $this->manager->search()->releasedYear('<', 'wrong');
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidRatingFilterException
     */
    public function testKissmangaSearchBuilderInvalidRatingFilterException()
    {
        $this->manager->search()->rating('wrong', '5');
    }

    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidRatingValueException
     */
    public function testKissmangaSearchBuilderInvalidRatingValueException()
    {
        $this->manager->search()->rating('<', 'wrong');
    }


    /**
     * @expectedException Railken\Kissmanga\Exceptions\KissmangaSearchBuilderInvalidCompletedValueException
     */
    public function testKissmangaSearchBuilderInvalidCompletedValueException()
    {
        $this->manager->search()->completed('wrong');
    }

    public function testBasics()
    {
       

        $m = $this->manager;


        # Search manga
        $results = $m
            ->search()
            ->type('any')
            ->name('contains', 'One Piece')
            ->author('contains', 'Oda Eiichiro')
            ->artist('contains', 'Oda Eiichiro')
            ->genres('include', ['Action', 'Drama', 'Historical'])
            ->releasedYear('<', '2017')
            ->rating('>', 4)
            ->completed(0)
            ->page(1)
            ->sortBy('name', 'ASC')
            ->get();

        $results = $results->results;
        
        $manga = $results->filter(function($v) {
            return $v->uid == 'one_piece';
        })->first();

        $this->assertEquals(106, $manga->id);


        // Send an empty request
        $results = $m
            ->search()
            ->get();

    }
}