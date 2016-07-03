<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 07-Apr-16
 * Time: 9:18 PM
 */

namespace BusinessLogic;

use Database\Model\Auction;
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

    /** @var string */
    private $sendTo;

    /**
     * SendAuctionViaEmailProcess constructor.
     * @param Application $app
     * @param SendMailProcess $sendMailProcess
     * @param $auctionList
     * @param $sendTo
     */
    public function __construct(Application $app, SendMailProcess $sendMailProcess, $auctionList, $sendTo)
    {
        $this->app = $app;
        $this->sendMailProcess = $sendMailProcess;
        $this->auctionList = $auctionList;
        $this->sendTo = $sendTo;
    }



    /**
     * @return void
     */
    public function execute()
    {
        $body = $this->getEmailBody();
        $this->sendMailProcess->setTo($this->sendTo);
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
}
