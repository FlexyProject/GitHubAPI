<?php

namespace FlexyProject\GitHub;

/**
 * Pagination
 * Requests that return multiple items will be paginated to 30 items by default.
 *
 * @link    https://developer.github.com/v3/#pagination
 * @package FlexyProject\GitHub
 */
class Pagination
{

    /**
     * Specify further pages.
     *
     * @var int|null
     */
    protected $page = null;

    /**
     * Set a custom page size up to 100.
     *
     * @var int|null
     */
    protected $limit = null;

    /**
     * Pagination constructor.
     *
     * @param int|null $page
     * @param int|null $limit
     */
    public function __construct(int $page = null, int $limit = null)
    {
        $this->page  = $page;
        $this->limit = $limit;
    }

    /**
     * Get page
     *
     * @return int|null
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set page
     *
     * @param int|null $page
     *
     * @return Pagination
     */
    public function setPage($page): Pagination
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get limit
     *
     * @return int|null
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set limit
     *
     * @param int|null $limit
     *
     * @return Pagination
     */
    public function setLimit($limit): Pagination
    {
        $this->limit = $limit;

        return $this;
    }
}
