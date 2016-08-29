<?php

namespace BusinessLogic;

use BusinessLogic\Interfaces\PageRenderSettings;
use Database\Model\NewsQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class HomePageRenderSettings implements PageRenderSettings
{
    /**
     * @return array
     */
    public function getRenderParams()
    {
        return array(
            'newsList' => $this->getNews()
        );
    }


    /**
     * @return \Database\Model\News[]|\Propel\Runtime\Collection\ObjectCollection
     */
    private function getNews()
    {
        return NewsQuery::create()
            ->orderByUpdatedAt(Criteria::DESC)
            ->find();
    }
}
