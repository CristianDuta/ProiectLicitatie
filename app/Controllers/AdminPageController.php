<?php

namespace Controllers;

use BusinessLogic\EmailAlertList;
use BusinessLogic\GetAuctionProcess;
use BusinessLogic\SaveAuctionProcess;
use BusinessLogic\SaveEmailAlertList;
use Database\Model\Auction;
use Database\Model\Mail;
use Database\Model\MailCriteriaQuery;
use Database\Model\MailCriteriaRelationQuery;
use Database\Model\MailQueue;
use Exception;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;

class AdminPageController extends AbstractAppController
{
    const PAGE_TITLE_HOME = 'Acasa';
    const PAGE_TITLE_ADD_AUCTION = 'Adauga Licitatie';
    const PAGE_TITLE_VIEW_DETAILS_AUCTION = 'Detalii Licitatie';
    const PAGE_TITLE_EDIT_AUCTION = 'Editeaza Licitatie';
    const PAGE_TITLE_VIEW_AUCTION_LIST = 'Vizualizare Licitatii';
    const PAGE_TITLE_VIEW_AUCTION = 'Vizualizare Licitatie';
    const PAGE_TITLE_MAIL_ALERTS = 'Alerte email';

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $this->setControllerCollection($app['controllers_factory']);

        $this->setUpHomePage();
        $this->setUpAddOrEditPage()->secure('ROLE_ADMIN');
        $this->setUpViewDetailsPage()->secure('ROLE_ADMIN');
        $this->setUpViewPage()->secure('ROLE_ADMIN');
        $this->setUpMailAlertsPage()->secure('ROLE_ADMIN');
        $this->setUpMailAlertsProvider()->secure('ROLE_ADMIN');
        $this->setUpSaveEmailAlerts()->secure('ROLE_ADMIN');
        $this->setUpSendAuctionListViaEmail()->secure('ROLE_ADMIN');

        return $this->getControllerCollection();
    }

    /**
     * @return \Silex\Controller|\BusinessLogic\SecureRoute
     */
    private function setUpHomePage()
    {
        return $this->getControllerCollection()->get('/', function (Application $app, Request $request) {

            if (!$app['security.authorization_checker']->isGranted('ROLE_ADMIN')) {
                return $app->redirect("/auth");
            }

            return $app['twig']->render("admin-index.html", array(
                'pageTitle' => self::PAGE_TITLE_HOME,
                'activeMenuItem' => 'home',
                'error' => $app['security.last_error']($request),
                'username' => $this->getUsername($app),
            ));
        });
    }

    /**
     * @return \Silex\Controller|\BusinessLogic\SecureRoute
     */
    private function setUpAddOrEditPage()
    {
        return $this->getControllerCollection()->match('/addOrEdit/{id}', function (Request $request, Application $app, $id) {
            $requestType = $request->getMethod();
            if ($requestType == 'POST') {
                $saveAuctionProcess = new SaveAuctionProcess();
                $saveAuctionProcess->setAuctionId($id);
                $saveAuctionProcess->setRequest($request);
                $id = $saveAuctionProcess->execute();
                return $app->redirect('/admin/addOrEdit/' . $id);
            }

            $auction   = array();
            $pageTitle = self::PAGE_TITLE_ADD_AUCTION;

            if (!empty($id)) {
                $pageTitle = self::PAGE_TITLE_EDIT_AUCTION;

                if (empty($auction)) {
                    $getAuctionProcess = new GetAuctionProcess();
                    $auction           = $getAuctionProcess->getOne($id)->toArray();
                }
            }

            return $app['twig']->render("admin-index.html", array(
                'pageTitle' => $pageTitle,
                'activeMenuItem' => 'addOrEdit',
                'username' => $this->getUsername($app),
                'pageContent' => $app['twig']->render("add-edit-auction.html", [
                    'inputArray' => $app['config']['addOrEditSection'],
                    'auctionList' => $auction,
                ])
            ));
        })->value('id', '');
    }

    /**
     * @return \Silex\Controller|\BusinessLogic\SecureRoute
     */
    private function setUpViewDetailsPage()
    {
        return $this->getControllerCollection()->match('/viewDetails/{id}', function (Request $request, Application $app, $id) {
            $requestType = $request->getMethod();
            if ($requestType == 'POST') {
                $saveAuctionProcess = new SaveAuctionProcess();
                $saveAuctionProcess->setAuctionId($id);
                $saveAuctionProcess->setRequest($request);
                $id = $saveAuctionProcess->execute();
                return $app->redirect('/admin/viewDetails/' . $id);
            }

            $auction   = array();
            $pageTitle = self::PAGE_TITLE_ADD_AUCTION;

            if (!empty($id)) {
                $pageTitle = self::PAGE_TITLE_VIEW_DETAILS_AUCTION;

                if (empty($auction)) {
                    $getAuctionProcess = new GetAuctionProcess();
                    $auction           = $getAuctionProcess->getOne($id)->toArray();
                }
            }

            return $app['twig']->render("admin-index.html", array(
                'pageTitle' => $pageTitle,
                'activeMenuItem' => 'viewDetails',
                'username' => $this->getUsername($app),
                'pageContent' => $app['twig']->render("view-details.html", [
                    'inputArray' => $app['config']['addOrEditSection'],
                    'auctionList' => $auction,
                ])
            ));
        })->value('id', '');
    }

    /**
     * @return \Silex\Controller|\BusinessLogic\SecureRoute
     */
    private function setUpViewPage()
    {
        return $this->getControllerCollection()->get('/view', function (Application $app) {

            $pageTitle = self::PAGE_TITLE_VIEW_AUCTION_LIST;

            $getAuctionProcess = new GetAuctionProcess();
            $auctionList       = $getAuctionProcess->getAll();

            $results = array();
            /** @var Auction $auction */
            foreach ($auctionList as $auction) {
                $result                    = array();
                $result['location']        = $auction->getLocation();
                $result['title']           = $auction->getTitle();
                $result['estimated_value'] = $auction->getEstimatedValue();
                $result['publish_date']    = $auction->getPublishDate("d.m.Y");
                $result['id']              = $auction->getId();
                $result['uniqueId']        = $auction->getUniqueId();

                $results[] = $result;
            }

            return $app['twig']->render("admin-index.html", array(
                'pageTitle' => $pageTitle,
                'activeMenuItem' => 'view',
                'username' => $this->getUsername($app),
                'pageContent' => $app['twig']->render("view.html", [
                    'auctionList' => $results,
                ])
            ));
        });
    }

    /**
     * @return \Silex\Controller|\BusinessLogic\SecureRoute
     */
    private function setUpMailAlertsPage()
    {
        return $this->getControllerCollection()->get('/emailAlerts', function (Application $app) {
            $mailAlertCriteriaList = MailCriteriaQuery::create()
                ->find();

            $tableColumns[0] = 'Email';
            foreach ($mailAlertCriteriaList as $mailAlertCriteria) {
                $tableColumns[$mailAlertCriteria->getId()] = $mailAlertCriteria->getName();
            }

            return $app['twig']->render("admin-index.html", array(
                'pageTitle' => self::PAGE_TITLE_MAIL_ALERTS,
                'activeMenuItem' => 'emailAlerts',
                'username' => $this->getUsername($app),
                'pageContent' => $app['twig']->render("emailAlerts.html", [
                    'tableColumns' => $tableColumns
                ]),
                'tableColumns' => $tableColumns
            ));
        });
    }

    /**
     * @return \Silex\Controller|\BusinessLogic\SecureRoute
     */
    private function setUpMailAlertsProvider()
    {
        return $this->getControllerCollection()->get('/getEmailAlertList', function (Application $app) {
            $emailAlertList = new EmailAlertList(MailCriteriaRelationQuery::create(), MailCriteriaQuery::create());

            return $app->json($emailAlertList->getDataTableResponse());
        });
    }

    /**
     * @return \Silex\Controller|\BusinessLogic\SecureRoute
     */
    private function setUpSaveEmailAlerts()
    {
        return $this->getControllerCollection()->post('/emailAlerts/save', function (Request $request, Application $app) {
            $emailAlerts = $request->get('emailAlerts');

            try {
                $saveEmailAlertList = new SaveEmailAlertList($emailAlerts);
                $saveEmailAlertList->execute();
            } catch (Exception $exception) {
                $statusMessage = $exception->getMessage();
            }

            return $app->json(array(
                'statusMessage' => !empty($statusMessage) ? $statusMessage : 'success'
            ));
        });
    }

    /**
     * @return \Silex\Controller|\BusinessLogic\SecureRoute
     */
    private function setUpSendAuctionListViaEmail()
    {
        return $this->getControllerCollection()->post('/sendAuctionViaEmail', function (Request $request, Application $app) {
            $emailSubject = $request->get('emailSubject');
            $emailList    = explode(",", $request->get('emailList'));
            $auctionList  = $request->get('auctionList');

            if (empty($emailSubject)) {
                $emailSubject = 'Alerta Licitatii !';
            }

            try {

                if (empty($emailList) || empty($auctionList)) {
                    throw new Exception("Ai uitat un camp obligatoriu");
                }

                $mail = new Mail();
                $mail->setSubject($emailSubject);
                $mail->setFromEmailAddress('licitatiepascupas@gmail.com');
                $mail->setAuctionList(implode(",", $auctionList));
                $mail->setMailTemplate("defaultEmailTemplate.html");
                $mail->save();

                foreach ($emailList as $email) {
                    $mailQueue = new MailQueue();
                    $mailQueue->setMailTo($email);
                    $mailQueue->setMail($mail);
                    $mailQueue->setMailStatus(MailQueue::MAIL_STATUS_NOT_SENT);
                    $mailQueue->save();
                }
            } catch (Exception $exception) {
                $statusMessage = $exception->getMessage();
            }

            return $app->json(array(
                'statusMessage' => !empty($statusMessage) ? $statusMessage : 'success'
            ));
        });
    }
}
