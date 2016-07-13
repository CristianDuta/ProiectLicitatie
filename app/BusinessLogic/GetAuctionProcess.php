<?php

namespace BusinessLogic;

use Database\Model\Auction;
use Database\Model\AuctionQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class GetAuctionProcess
{
    /**
     * @param int $auctionUniqueId
     * @return Auction
     */
    public function getOne($auctionUniqueId = null)
    {
        $auctionQuery = new AuctionQuery();
        if ($auctionUniqueId) {
            $auctionQuery->filterByUniqueId($auctionUniqueId);
        }
        return $auctionQuery->findOne();
    }



    /**
     * @return Auction[]
     */
    public function getAll()
    {
        $auctionQuery = new AuctionQuery();
        return $auctionQuery->find();
    }



    public function getAuctionsWithLimit($limit = 1)
    {
        $auctionQuery = new AuctionQuery();
        return $auctionQuery
            ->groupByLocation()
            ->orderById(Criteria::DESC)
            ->limit($limit)
            ->find();
    }
}
