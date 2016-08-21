<?php

namespace BusinessLogic;

use BusinessLogic\Interfaces\PageRenderSettings;
use Database\Model\Auction;

class AuctionsPageRenderSettings implements PageRenderSettings
{
    public function getRenderParams()
    {
        return array(
            'auctionList' => $this->getAuctionList()
        );
    }


    /**
     * @return Auction[]
     */
    private function getAuctionList()
    {
        $getAuctionProcess = new GetAuctionProcess();
        $auctionList       = $getAuctionProcess->getAll();

        $results = array();
        /** @var Auction $auction */
        foreach ($auctionList as $auction) {
            $result                    = array();
            $result['location']        = $auction->getLocation();
            $result['title']           = $auction->getTitle();
            $result['estimated_value'] = $auction->getEstimatedValue();
            $result['publish_date']    = $auction->getPublishDate("d.m.Y");
            $result['id']              = $auction->getId();
            $result['uniqueId']        = $auction->getUniqueId();

            $results[] = $result;
        }

        return $results;
    }
}
