<?php

namespace Database\Model;

use Database\Model\Base\News as BaseNews;
use Propel\Runtime\Connection\ConnectionInterface;

/**
 * Skeleton subclass for representing a row from the 'news' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class News extends BaseNews
{
    const UNIQUE_ID_SEED = 'auctionStepByStepNewsSeed';

    /**
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if ($this->isNew()) {
            $this->setUniqueId(md5(self::UNIQUE_ID_SEED . time()));
        }

        return parent::preSave($con);
    }
}
