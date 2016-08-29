<?php

namespace BusinessLogic;

use BusinessLogic\Interfaces\PageRenderSettings;
use Database\Model\NewsQuery;

class NewsPageRenderSettings implements PageRenderSettings
{
    /**
     * @var string
     */
    private $pageValue;

    /**
     * NewsPageRenderSettings constructor.
     * @param string $pageValue
     */
    public function __construct($pageValue)
    {
        $this->pageValue = $pageValue;
    }


    public function getRenderParams()
    {
        $news = NewsQuery::create()
            ->findOneByUniqueId($this->pageValue);

        return [
            'newsTitle' => $news->getTitle(),
            'newsDescription' => $news->getDescription()
        ];
    }
}