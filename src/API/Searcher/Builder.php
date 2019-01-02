<?php

namespace Railken\Kissmanga\API\Searcher;

use Illuminate\Support\Collection;
use Railken\Bag;
use Railken\Kissmanga\Kissmanga;

class Builder
{
    /**
     * @var Kissmanga
     */
    protected $manager;

    /**
     * Name of resource searched.
     *
     * @var Bag
     */
    protected $name;

    /**
     * Name of author searched.
     *
     * @var Bag
     */
    protected $author;

    /**
     * Genres.
     *
     * @var Bag
     */
    protected $genres;

    /**
     * Completed.
     *
     * @var bool
     */
    protected $completed = null;

    /**
     * Construct.
     *
     * @param Kissmanga $manager
     */
    public function __construct(Kissmanga $manager)
    {
        $this->manager = $manager;
        $this->name = new Bag();
        $this->author = new Bag();
        $this->genres = new Bag();
        $this->genres->set('value', new Collection());
    }

    /**
     * Throw an exceptions if value doesn't match with suggestion.
     *
     * @param string $class
     * @param mixed  $value
     * @param array  $suggestions
     */
    public function throwExceptionInvalidValue($class, $value, $suggestions)
    {
        if (is_array($value)) {
            if (count(array_diff($value, $suggestions)) != 0) {
                throw new $class($value, $suggestions);
            }
        } else {
            if (!in_array($value, $suggestions)) {
                throw new $class($value, $suggestions);
            }
        }
    }

    /**
     * Set the name of resource searched.
     *
     * @param string $name
     *
     * @return $this
     */
    public function name($name)
    {
        $this->name
            ->set('value', $name);

        return $this;
    }

    /**
     * Retrieve name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the author of resource searched.
     *
     * @param string $author
     *
     * @return $this
     */
    public function author($author)
    {
        $this->author
            ->set('value', $author);

        return $this;
    }

    /**
     * Retrieve author.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set genres.
     *
     * @param string $filter
     * @param array  $genres
     */
    public function genres($filter, $genres)
    {
        $this->throwExceptionInvalidValue(Exceptions\BuilderInvalidGenresFilterException::class, $filter, ['include', 'exclude']);

        $this->throwExceptionInvalidValue(Exceptions\BuilderInvalidGenresValueException::class, $genres, $this->manager->getGenres());

        $this->genres
            ->set('filter', $filter)
            ->set('value', new Collection($genres));

        return $this;
    }

    /**
     * Retrieve genres.
     *
     * @return Bag
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Set the sort of resource searched.
     *
     * @param string $value
     *
     * @return $this
     */
    public function completed($value)
    {
        $this->throwExceptionInvalidValue(Exceptions\BuilderInvalidCompletedValueException::class, $value, [null, '1', '0']);

        $this->completed = (bool) $value;

        return $this;
    }

    /**
     * Retrieve sort.
     *
     * @return string
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Send request.
     *
     * @return Response
     */
    public function get()
    {
        $request = new Request($this->manager);

        return $request->send($this);
    }
}
