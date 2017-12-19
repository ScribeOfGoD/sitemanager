<?php

namespace YeTii\SiteManager\Traits;

trait HasSiteName
{
    /**
     * @var string
     */
    protected $siteName;

    /**
     * @return string
     */
    public function getSiteName(): string
    {
        return $this->siteName;
    }

    /**
     * @param string $siteName
     */
    public function setSiteName(string $siteName)
    {
        $this->siteName = $siteName;
    }
}