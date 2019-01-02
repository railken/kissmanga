<?php

namespace Railken\Kissmanga\API\Scan;

use Railken\Kissmanga\Kissmanga;

class Builder
{
    /**
     * @var Kissmanga
     */
    protected $manager;

    /**
     * @var string
     */
    protected $manga_uid;

    /**
     * @var string
     */
    protected $chapter_id;

    /**
     * Construct.
     *
     * @param Kissmanga $manager
     */
    public function __construct(Kissmanga $manager)
    {
        $this->manager = $manager;
    }

    /**
     * manga_uid.
     *
     * @param string $manga_uid
     *
     * @return $this
     */
    public function mangaUid($manga_uid)
    {
        $this->manga_uid = $manga_uid;

        return $this;
    }

    /**
     * Return manga_uid.
     *
     * @return string
     */
    public function getMangaUid()
    {
        return $this->manga_uid;
    }

    /**
     * chapter_id.
     *
     * @param string $chapter_id
     *
     * @return $this
     */
    public function chapterId($chapter_id)
    {
        $this->chapter_id = $chapter_id;

        return $this;
    }

    /**
     * Return chapter_number.
     *
     * @return string
     */
    public function getChapterId()
    {
        return $this->chapter_id;
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
