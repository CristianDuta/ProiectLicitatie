<?php

namespace BusinessLogic;

use Database\Model\Base\MailCriteriaQuery;
use Database\Model\Base\MailCriteriaRelationQuery;

class EmailAlertList
{
    /** @var MailCriteriaRelationQuery */
    private $mailCriteriaRelationQuery;

    /** @var MailCriteriaQuery */
    private $mailCriteriaQuery;

    public function __construct(MailCriteriaRelationQuery $mailCriteriaRelationQuery, MailCriteriaQuery $mailCriteriaQuery)
    {
        $this->mailCriteriaRelationQuery = $mailCriteriaRelationQuery;
        $this->mailCriteriaQuery = $mailCriteriaQuery;
    }


    /**
     * @return array
     */
    public function getDataTableResponse()
    {
        $relations = $this->getRelationsAsArray();
        $mailCriteriaList = $this->mailCriteriaQuery->find();

        $responseData = [];
        foreach ($relations as $email => $criteria) {
            $entry = array();
            $entry[] = $email;

            foreach ($mailCriteriaList as $mailCriteria) {
                $entry[] = !empty($relations[$email][$mailCriteria->getId()]);
            }

            $responseData[] = $entry;
        }

        return $responseData;
    }


    /**
     * @return array
     */
    private function getRelationsAsArray()
    {
        $mailCriteriaRelationList = $this->mailCriteriaRelationQuery->find();

        $partialResult = [];
        foreach ($mailCriteriaRelationList as $mailCriteriaRelation) {
            $partialResult[$mailCriteriaRelation->getEmailAddress()][$mailCriteriaRelation->getMailCriteriaId()] = true;
        }
        return $partialResult;
    }
}