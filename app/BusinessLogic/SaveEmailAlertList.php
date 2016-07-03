<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 29-Jun-16
 * Time: 11:06 PM
 */

namespace BusinessLogic;

use Database\Model\Base\MailCriteriaRelationQuery;
use Symfony\Component\Config\Definition\Exception\Exception;

class SaveEmailAlertList
{
    private $emailAlertList;

    public function __construct($emailAlertList)
    {
        $this->emailAlertList = $emailAlertList;
    }


    public function execute()
    {
        $emailAddress = '';
        foreach ($this->emailAlertList as $emailAlert) {
            foreach ($emailAlert as $mailCriteriaId => $mailCriteriaValue) {
                if ($mailCriteriaId == 0) {
                    $emailAddress = $mailCriteriaValue;
                } elseif ($mailCriteriaValue == 'true') {
                    $this->addNewMailCriteriaRelation($emailAddress, $mailCriteriaId);
                } elseif ($mailCriteriaValue == 'false') {
                    $this->removeMailCriteriaRelation($emailAddress, $mailCriteriaId);
                }
            }
        }
    }


    private function addNewMailCriteriaRelation($emailAddress, $mailCriteriaId)
    {
        MailCriteriaRelationQuery::create()
            ->filterByEmailAddress($emailAddress)
            ->filterByMailCriteriaId($mailCriteriaId)
            ->findOneOrCreate()
            ->save();
    }


    private function removeMailCriteriaRelation($emailAddress, $mailCriteriaId)
    {
        MailCriteriaRelationQuery::create()
            ->filterByEmailAddress($emailAddress)
            ->filterByMailCriteriaId($mailCriteriaId)
            ->delete();
    }
}