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
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getEstimatedValue(),
            $keys[3] => $this->getLocation(),
            $keys[4] => $this->getDocumentation(),
            $keys[5] => $this->getAdNumber(),
            $keys[6] => $this->getPublishDate("d.m.Y"),
            $keys[7] => $this->getGainer(),
            $keys[8] => $this->getContractType(),
            $keys[9] => $this->getFundingType(),
            $keys[10] => $this->getContractSubject(),
            $keys[11] => $this->getOfferEndDate('d.m.Y'),
            $keys[12] => $this->getApplyMode(),
            $keys[13] => $this->getContractPeriod(),
            $keys[14] => $this->getParticipationWarranty(),
            $keys[15] => $this->getParticipationConditions(),
            $keys[16] => $this->getProfessionalAbility(),
            $keys[17] => $this->getAverageTurnover(),
            $keys[18] => $this->getCashFlow(),
            $keys[19] => $this->getSimilarExperience(),
            $keys[20] => $this->getKeyPersonnel(),
            $keys[21] => $this->getEquipment(),
            $keys[22] => $this->getQualityAssurance(),
            $keys[23] => $this->getAdditionalInformation(),
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
