<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 03-Jul-16
 * Time: 3:02 PM
 */

namespace BusinessLogic;

use Database\Model\AuctionQuery;
use Database\Model\Mail;
use Database\Model\MailCriteria;
use Propel\Runtime\ActiveQuery\Criteria;
use Silex\Application;

class CreateMailProcess
{
    const EMAIL_SUBJECT = 'Alerta Licitatii !';
    const AUCTION_ID_SEPARATOR = ',';

    /** @var Application */
    private $app;

    /** @var MailCriteria */
    private $mailCriteria;

    /**
     * @param Application $app
     * @param MailCriteria $mailCriteria
     */
    public function __construct(Application $app, MailCriteria $mailCriteria)
    {
        $this->app = $app;
        $this->mailCriteria = $mailCriteria;
    }



    /**
     * @return Mail
     */
    public function createMail()
    {
        $mail = new Mail();
        $auctionList = $this->getAuctionList();

        if (!empty($auctionList)) {
            $mail->setFromEmailAddress($this->app['config']['send_mail']['from']);
            $mail->setSubject(self::EMAIL_SUBJECT);
            $mail->setMailTemplate("defaultEmailTemplate.html");
            $mail->setAuctionList($auctionList);
            $mail->save();
            return $mail;
        }

        return false;
    }


    /**
     * @return string - comma separated
     */
    private function getAuctionList()
    {
        $auctionList = AuctionQuery::create()
            ->filterByContractType($this->mailCriteria->getName())
            ->orderByUpdatedAt(Criteria::DESC)
            ->limit(3)
            ->find();

        $auctionArrayList = array();
        foreach ($auctionList as $auction) {
            $auctionArrayList[] = $auction->getId();
        }

        return implode(self::AUCTION_ID_SEPARATOR, $auctionArrayList);
    }
}