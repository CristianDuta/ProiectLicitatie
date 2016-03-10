<?php

namespace Database\Model;

use Database\Model\Base\Auction as BaseAuction;

/**
 * Skeleton subclass for representing a row from the 'auction' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Auction extends BaseAuction
{
    public function setPublishDate($value)
    {
        $date = date("Y-m-d", strtotime($value));
        parent::setPublishDate($date);
        return $this;
    }
}
