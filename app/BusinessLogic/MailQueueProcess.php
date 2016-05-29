<?php

namespace BusinessLogic;

use Database\Model\UserQuery;
use Knp\Command\Command;
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
        try {
            $app             = $this->getSilexApplication();
            $sendMailProcess = $this->getSendMailProcess();
            $auctionList     = $this->getAuctionList();
            $userList        = $this->getUserList();

            $sendAuctionViaEmailProcess = new SendAuctionViaEmailProcess($app, $sendMailProcess, $auctionList, $userList);
            $sendAuctionViaEmailProcess->execute();
        } catch (\Exception $exception) {
            $output->writeln($exception->getMessage());
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
     * @return array|\Database\Model\Auction[]
     */
    private function getAuctionList()
    {
        $getAuctionProcess = new GetAuctionProcess();
        $auctionList = $getAuctionProcess->getAuctionsWithLimit(3);

        return $auctionList;
    }


    /**
     * @return array|\Database\Model\User[]
     */
    private function getUserList()
    {
        $userList = UserQuery::create()
            ->filterByLastName('Duta')
            ->find();
        return $userList;
    }
}
