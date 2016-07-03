<?php

namespace BusinessLogic;

use Database\Model\AuctionQuery;
use Database\Model\MailQueue;
use Database\Model\MailQueueQuery;
use Knp\Command\Command;
use Propel\Runtime\ActiveQuery\Criteria;
use Swift_Message;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MailQueueProcess extends Command
{
    protected function configure()
    {
        $this->setName("sendMail");
        $this->setDescription("Process mail queue and send emails");
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app             = $this->getSilexApplication();
        $sendMailProcess = $this->getSendMailProcess();
        $queueItemList   = $this->getQueueItemList();

        foreach ($queueItemList as $queueItem) {
            $auctionList = $this->getAuctionList($queueItem);

            $sendAuctionViaEmailProcess = new SendAuctionViaEmailProcess($app, $sendMailProcess, $auctionList, $queueItem->getMailTo());
            $sendAuctionViaEmailProcess->execute();
            $this->markQueueItemAsSent($queueItem);
        }
    }


    /**
     * @return SendMailProcess
     */
    private function getSendMailProcess()
    {
        $app             = $this->getSilexApplication();
        $message         = Swift_Message::newInstance();
        $sendMailProcess = new SendMailProcess($app, $message);
        return $sendMailProcess;
    }


    /**
     * @param MailQueue $queueItem
     * @return array|\Database\Model\Auction[]
     */
    private function getAuctionList($queueItem)
    {
        $mailQueueItemList = MailQueueQuery::create()
            ->filterByMailTo($queueItem->getMailTo())
            ->filterByMailStatus(MailQueue::MAIL_STATUS_NOT_SENT)
            ->find();
        $auctionList = array();
        foreach ($mailQueueItemList as $mailQueueItem) {
            $mail = $mailQueueItem->getMail();
            $auctionList = array_merge($auctionList, explode(CreateMailProcess::AUCTION_ID_SEPARATOR, $mail->getAuctionList()));
        }

        return AuctionQuery::create()
            ->filterById($auctionList)
            ->orderByUpdatedAt(Criteria::DESC)
            ->find();
    }


    /**
     * @return \Database\Model\MailQueue[]|\Propel\Runtime\Collection\ObjectCollection
     */
    protected function getQueueItemList()
    {
        $queueItemList = MailQueueQuery::create()
            ->filterByMailStatus(MailQueue::MAIL_STATUS_NOT_SENT)
            ->groupByMailTo()
            ->find();
        return $queueItemList;
    }

    /**
     * @param MailQueue $queueItem
     */
    protected function markQueueItemAsSent($queueItem)
    {
        $mailQueueItemList = MailQueueQuery::create()
            ->filterByMailTo($queueItem->getMailTo())
            ->filterByMailStatus(MailQueue::MAIL_STATUS_NOT_SENT)
            ->find();

        foreach ($mailQueueItemList as $mailQueueItem) {
            $mailQueueItem
                ->setMailStatus(MailQueue::MAIL_STATUS_SENT)
                ->save();
        }
    }
}
