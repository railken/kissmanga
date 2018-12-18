<?php

namespace Railken\Kissmanga;

class Kissmanga extends KissmangaReader
{

    /**
     * Base url Kissmanga
     *
     * @var string
     */
    protected $urls = [
        'app' => 'https://kissmanga.com',
    ];

    /**
     * List of genres available on Kissmanga
     *
     * @var string[]
     */
    protected $genres = [
        "4-Koma",
        "Action",
        "Adult",
        "Adventure",
        "Comedy",
        "Comic",
        "Cooking",
        "Doujinshi",
        "Drama",
        "Ecchi",
        "Fantasy",
        "Gender Bender",
        "Harem",
        "Historical",
        "Horror",
        "Josei",
        "Lolicon",
        "Manga",
        "Manhua",
        "Manhwa",
        "Martial Arts",
        "Mature",
        "Mecha",
        "Medical",
        "Music",
        "Mystery",
        "One shot",
        "Psychological",
        "Romance",
        "School Life",
        "Sci-fi",
        "Seinen",
        "Shotacon",
        "Shoujo",
        "Shoujo Ai",
        "Shounen",
        "Shounen Ai",
        "Slice of Life",
        "Smut",
        "Sports",
        "Supernatural",
        "Tragedy",
        "Webtoon",
        "Yaoi",
        "Yuri"
    ];

    /**
     * Retrieve base url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Perform a search
     *
     * @return KissmangaSearchBuilder
     */
    public function search()
    {
        return new API\Searcher\Builder($this);
    }

    /**
     * Request a specific resource
     *
     * @param string $uid
     *
     * @return KissmangaResourceBuilder
     */
    public function resource($uid = null)
    {
        return (new API\Resource\Builder($this))->uid($uid);
    }

    /**
     * Request all scans for a chapter
     *
     * @param string $manga_uid
     * @param string $chapter_id
     *
     * @return KissmangaScanBuilder
     */
    public function scan($manga_uid, $chapter_id)
    {
        return (new API\Scan\Builder($this))->mangaUid($manga_uid)->chapterId($chapter_id);
    }

    /**
     * Perform a search in last releases
     *
     * @return KissmangaReleasesBuilder
     */
    public function releases()
    {
        return new API\Releases\Builder($this);
    }

    /**
     * Perform a search in directory
     *
     * @return KissmangaDirectoryBuilder
     */
    public function directory()
    {
        return $this->search();
    }

    /**
     * Retrieve a list of all resources
     *
     * @return KissmangaIndexBuilder
     */
    public function index()
    {
        return $this->search();
    }

    /**
     * Retrieve genres available on Kissmanga
     *
     * @return array
     */
    public function getGenres()
    {
        return $this->genres;
    }
}
