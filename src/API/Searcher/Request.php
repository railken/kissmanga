<?php

namespace Railken\Kissmanga\API\Searcher;

use Illuminate\Support\Collection;

use Railken\Kissmanga\Kissmanga;

class Request
{
    
    /*
     * @var Kissmanga
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param Kissmanga $manager
     */
    public function __construct(Kissmanga $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Send the request for the research
     *
     * @param KissmangaSearchBuilder $builder
     *
     * @return KissmangaSearchResponse
     */
    public function send(Builder $builder)
    {
        $params = [];
        
        # Name
        $params['name'] = str_replace("%20", " ", $builder->getName()->get('value'));

        # Author
        $params['author'] = $builder->getAuthor()->get('value');

        # Genres
        $params['genres'] = (new Collection($this->manager->getGenres()))->mapWithKeys(function ($item, $key) use ($builder) {

            return [$key => in_array($item, $builder->getGenres()->get('value')->toArray()) ? ($builder->getGenres()->get('filter') == 'include' ? 1 : 2) : 0];
        })->toArray();


        # Is completed?
        $builder->getCompleted() === null   && $params['status'] = 'Any';
        $builder->getCompleted() === 0      && $params['status'] = 'Ongoing';
        $builder->getCompleted() === 1      && $params['status'] = 'Completed';


        print_r($params);
        $results = $this->manager->request("POST", "/AdvanceSearch", $params);

        $parser = new Parser($this->manager);

        return $parser->parse($results);
    }
}
