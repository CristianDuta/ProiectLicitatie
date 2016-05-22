<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 07-Apr-16
 * Time: 9:18 PM
 */

namespace BusinessLogic;

use Database\Model\Auction;
use Database\Model\User;
use Silex\Application;

class SendAuctionViaEmailProcess
{
    const EMAIL_IMAGES_PATH = "web/assets/images/email/";
    const EMAIL_SUBJECT = 'Alerta Licitatii !';

    /** @var Application */
    private $app;

    /** @var SendMailProcess */
    private $sendMailProcess;

    /** @var Auction[] */
    private $auctionList;

    /** @var User[] */
    private $userList;

    /**
     * SendAuctionViaEmailProcess constructor.
     * @param Application $app
     * @param SendMailProcess $sendMailProcess
     * @param $auctionList
     * @param $userList
     */
    public function __construct(Application $app, SendMailProcess $sendMailProcess, $auctionList, $userList)
    {
        $this->app = $app;
        $this->sendMailProcess = $sendMailProcess;
        $this->auctionList = $auctionList;
        $this->userList = $userList;
    }



    /**
     * @return void
     */
    public function execute()
    {
        $to = $this->getSendTo();
        $body = $this->getEmailBody();
        $this->sendMailProcess->setTo($to);
        $this->sendMailProcess->setSubject(self::EMAIL_SUBJECT);
        $this->sendMailProcess->setBody($body);
        $this->sendMailProcess->execute();
    }



    /**
     * @return string
     */
    private function getEmailBody()
    {
        return $this->app['twig']->render("defaultEmailTemplate.html", array(
            'website' => $this->app['local_config']['website_address'],
            'logoPath' => $this->getImageToEmbed('logo.png'),
            'headerLine' => $this->getImageToEmbed('headerLine.jpg'),
            'houseImage' => $this->getImageToEmbed('house.png'),
            'auctionList' => $this->auctionList
        ));
    }


    /**
     * @param $imageName
     * @return string
     */
    private function getImageToEmbed($imageName)
    {
        return $this->sendMailProcess->getImagePath(
            $this->app['local_config']['root_path'] .
            self::EMAIL_IMAGES_PATH .
            $imageName
        );
    }



    /**
     * @return array
     */
    private function getSendTo()
    {
        $sendTo = array();

        /** @var User $user */
        foreach ($this->userList as $user) {
            $sendTo[] = $user->getEmail();
        }

        return $sendTo;
    }
}
