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
        'app' => 'http://kissmanga.com/',
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
        return new KissmangaSearchBuilder($this);
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
        return (new KissmangaResourceBuilder($this))->uid($uid);
    }

    /**
     * Request all scans for a chapter
     *
     * @param string $manga_uid
     * @param string $volume_number
     * @param string $chapter_number
     *
     * @return KissmangaScanBuilder
     */
    public function scan($manga_uid, $volume_number, $chapter_number)
    {
        return (new KissmangaScanBuilder($this))->mangaUid($manga_uid)->volumeNumber($volume_number)->chapterNumber($chapter_number);
    }

    /**
     * Perform a search in last releases
     *
     * @return KissmangaReleasesBuilder
     */
    public function releases()
    {
        return new KissmangaReleasesBuilder($this);
    }

    /**
     * Perform a search in directory
     *
     * @return KissmangaDirectoryBuilder
     */
    public function directory()
    {
        return new KissmangaDirectoryBuilder($this);
    }

    /**
     * Retrieve a list of all resources
     *
     * @return KissmangaIndexBuilder
     */
    public function index()
    {
        return new KissmangaIndexBuilder($this);
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
