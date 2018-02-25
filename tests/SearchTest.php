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
     * @expectedException Railken\Kissmanga\API\Searcher\Exceptions\BuilderInvalidGenresFilterException
     */
    public function testKissmangaSearchBuilderInvalidGenresFilterException()
    {
        $this->manager->search()->genres('wrong', ['Action']);
    }

    /**
     * @expectedException Railken\Kissmanga\API\Searcher\Exceptions\BuilderInvalidGenresValueException
     */
    public function testKissmangaSearchBuilderInvalidGenresValueException()
    {
        $this->manager->search()->genres('include', ['Food']);
    }

    /**
     * @expectedException Railken\Kissmanga\API\Searcher\Exceptions\BuilderInvalidCompletedValueException
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
            ->name('One Piece')
            ->author('Oda Eiichiro')
            ->genres('include', ['Action', 'Drama', 'Adventure'])
            ->completed(1)
            ->get();

        $results = $results->results;

        print_r($results);
        
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