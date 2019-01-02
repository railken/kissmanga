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
     * Constructor.
     *
     * @param Kissmanga $manager
     */
    public function __construct(Kissmanga $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Send the request for the research.
     *
     * @param KissmangaSearchBuilder $builder
     *
     * @return KissmangaSearchResponse
     */
    public function send(Builder $builder)
    {
        $params = [];

        // Name
        $params['mangaName'] = str_replace('%20', ' ', $builder->getName()->get('value'));

        // Author
        $params['authorArtist'] = $builder->getAuthor()->get('value');

        // Genres
        $params['genres'] = (new Collection($this->manager->getGenres()))->mapWithKeys(function ($item, $key) use ($builder) {
            return [$key => in_array($item, $builder->getGenres()->get('value')->toArray()) ? ($builder->getGenres()->get('filter') == 'include' ? 1 : 2) : 0];
        })->toArray();

        // Is completed?
        $builder->getCompleted() == false && $params['status'] = 'Ongoing';
        $builder->getCompleted() == true && $params['status'] = 'Completed';
        $builder->getCompleted() === null && $params['status'] = '';

        $query = http_build_query($params, null, '&');
        $string = preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $query);

        $results = $this->manager->request('POST', '/AdvanceSearch', $string);

        $parser = new Parser($this->manager);

        return $parser->parse($results);
    }
}
