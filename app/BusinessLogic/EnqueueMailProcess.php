<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 03-Jul-16
 * Time: 2:42 PM
 */

namespace BusinessLogic;

use Database\Model\Mail;
use Database\Model\MailCriteria;
use Database\Model\MailCriteriaQuery;
use Database\Model\MailCriteriaRelation;
use Database\Model\MailCriteriaRelationQuery;
use Database\Model\MailQueue;
use Knp\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EnqueueMailProcess extends Command
{
    protected function configure()
    {
        $this->setName("enqueueMail");
        $this->setDescription("Add mail to queue");
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // read from mailCriteria
        // foreach mailCriteria -> create Mail, add mailQueue items
        $mailCriteriaList = MailCriteriaQuery::create()->find();

        /** @var MailCriteria $mailCriteria */
        foreach ($mailCriteriaList as $mailCriteria) {
            if (!$mail = $this->createMailFromMailCriteria($mailCriteria)) {
                continue;
            }
            $mailCriteriaRelationList = $this->getMailCriteriaRelationList($mailCriteria);

            /** @var MailCriteriaRelation $mailCriteriaRelation */
            foreach ($mailCriteriaRelationList as $mailCriteriaRelation) {
                $this->createMailQueue($mail, $mailCriteriaRelation);
            }
        }
    }


    /**
     * @param MailCriteria $mailCriteria
     * @return Mail
     */
    private function createMailFromMailCriteria(MailCriteria $mailCriteria)
    {
        $createMailProcess = new CreateMailProcess($this->getSilexApplication(), $mailCriteria);
        return $createMailProcess->createMail();
    }


    /**
     * @param MailCriteria $mailCriteria
     * @return \Database\Model\MailCriteriaRelation[]|\Propel\Runtime\Collection\ObjectCollection
     * @throws \Propel\Runtime\Exception\PropelException
     */
    private function getMailCriteriaRelationList(MailCriteria $mailCriteria)
    {
        return MailCriteriaRelationQuery::create()
            ->filterByMailCriteria($mailCriteria)
            ->find();
    }


    /**
     * @param Mail $mail
     * @param MailCriteriaRelation $mailCriteriaRelation
     * @return void
     */
    private function createMailQueue(Mail $mail, MailCriteriaRelation $mailCriteriaRelation)
    {
        $mailQueue = new MailQueue();
        $mailQueue->setMail($mail);
        $mailQueue->setMailTo($mailCriteriaRelation->getEmailAddress());
        $mailQueue->save();
    }
}
