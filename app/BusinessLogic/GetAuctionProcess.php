<?php

namespace BusinessLogic;

use Database\Model\Auction;
use Database\Model\AuctionQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class GetAuctionProcess
{
    /**
     * @param int $auctionId
     * @return Auction
     */
    public function getOne($auctionId = null)
    {
        $auctionQuery = new AuctionQuery();
        if ($auctionId) {
            $auctionQuery->filterById($auctionId);
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
