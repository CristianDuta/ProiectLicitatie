<?php

namespace Database\Model;

use Database\Model\Base\Auction as BaseAuction;
use Database\Model\Map\AuctionTableMap;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Map\TableMap;

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
    const UNIQUE_ID_SEED = 'auctionStepByStep';


    public function setPublishDate($value)
    {
        $date = date("Y-m-d", strtotime($value));
        parent::setPublishDate($date);
        return $this;
    }


    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {
        if (isset($alreadyDumpedObjects['Auction'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Auction'][$this->hashCode()] = true;
        $keys = AuctionTableMap::getFieldNames($keyType);
        $result = array(
            $keys[1] => $this->getUniqueId(),
            $keys[2] => $this->getTitle(),
            $keys[3] => $this->getEstimatedValue(),
            $keys[4] => $this->getLocation(),
            $keys[5] => $this->getDocumentation(),
            $keys[6] => $this->getAdNumber(),
            $keys[7] => $this->getPublishDate("d.m.Y"),
            $keys[8] => $this->getGainer(),
            $keys[9] => $this->getContractType(),
            $keys[10] => $this->getFundingType(),
            $keys[11] => $this->getContractSubject(),
            $keys[12] => $this->getOfferEndDate('d.m.Y'),
            $keys[13] => $this->getApplyMode(),
            $keys[14] => $this->getContractPeriod(),
            $keys[15] => $this->getParticipationWarranty(),
            $keys[16] => $this->getParticipationConditions(),
            $keys[17] => $this->getProfessionalAbility(),
            $keys[18] => $this->getAverageTurnover(),
            $keys[19] => $this->getCashFlow(),
            $keys[20] => $this->getSimilarExperience(),
            $keys[21] => $this->getKeyPersonnel(),
            $keys[22] => $this->getEquipment(),
            $keys[23] => $this->getQualityAssurance(),
            $keys[24] => $this->getAdditionalInformation(),
        );

        return $result;
    }


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
