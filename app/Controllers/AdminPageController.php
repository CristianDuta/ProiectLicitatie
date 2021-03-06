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
use Database\Model\News;
use Database\Model\NewsQuery;
use Database\Model\SubscriptionQuery;
use Exception;
use Propel\Runtime\ActiveQuery\Criteria;
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
    const PAGE_TITLE_ADD_NEWS = 'Adauga stire noua';
    const PAGE_TITLE_EDIT_NEWS = 'Editeaza stire';
    const PAGE_TITLE_NEWS_LIST = 'Vizualizare stiri';
    const PAGE_TITLE_SUBSCRIPTION_LIST = 'Vizualizare abonamente';
    const PAGE_TITLE_SUBSCRIPTION_EDIT = 'Actualizeaza abonament';

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
        $this->setUpNewsListPage()->secure('ROLE_ADMIN');
        $this->setUpAddOrEditNewsPage()->secure('ROLE_ADMIN');
        $this->setUpDeleteNewsPage()->secure('ROLE_ADMIN');
        $this->setUpSubscriptionPage()->secure('ROLE_ADMIN');
        $this->setUpEditSubscriptionPage()->secure('ROLE_ADMIN');

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
                    'auction' => $auction,
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
    private function setUpSubscriptionPage()
    {
        return $this->getControllerCollection()->get('/subscriptionList', function (Application $app) {
            $subscriptionList = SubscriptionQuery::create()
                ->orderByUpdatedAt(Criteria::DESC)
                ->find()
                ->toArray();

            return $app['twig']->render("admin-index.html", array(
                'pageTitle' => self::PAGE_TITLE_SUBSCRIPTION_LIST,
                'activeMenuItem' => 'subscriptionList',
                'username' => $this->getUsername($app),
                'pageContent' => $app['twig']->render("subscriptionList.html", [
                    'inputArray' => [
                        "CompanyName" => 'Companie',
                        "CompanyAddress" => 'Adresa',
                        "CompanyCui" => 'CUI',
                        "CompanyRepresentative" => 'Reprezentant companie',
                        "IbanAccount" => 'Cont IBAN',
                        "EmailAddress" => 'Adresa e-mail',
                        "PhoneNumber" => 'Telefon',
                        "CreatedAt" => 'Adaugat la data',
                        "UpdatedAt" => 'Actualizat la data',
                    ],
                    'subscriptionList' => $subscriptionList,
                ])
            ));
        });
    }

    /**
     * @return \Silex\Controller|\BusinessLogic\SecureRoute
     */
    private function setUpEditSubscriptionPage()
    {
        return $this->getControllerCollection()->match('/subscription/{id}', function (Request $request, Application $app, $id) {
            if (empty($id)) {
                return $app->redirect('/admin/subscriptionList');
            }

            $subscription = SubscriptionQuery::create()
                ->filterById($id)
                ->findOne();

            if ($request->getMethod() == 'POST') {
                $subscription->setCompanyName($request->get('companyName'));
                $subscription->setCompanyAddress($request->get('companyAddress'));
                $subscription->setCompanyCui($request->get('companyCui'));
                $subscription->setCompanyRepresentative($request->get('companyRepresentative'));
                $subscription->setIbanAccount($request->get('companyIban'));
                $subscription->setEmailAddress($request->get('email'));
                $subscription->setPhoneNumber($request->get('phoneNumber'));
                $subscription->save();

                return $app->redirect('/admin/subscriptionList');
            }

            return $app['twig']->render("admin-index.html", array(
                'pageTitle' => self::PAGE_TITLE_SUBSCRIPTION_EDIT,
                'activeMenuItem' => 'subscriptionList',
                'username' => $this->getUsername($app),
                'pageContent' => $app['twig']->render("edit-subscription.html", [
                    'subscription' => $subscription
                ])
            ));
        })->value('id', '');
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

    /**
     * @return \Silex\Controller|\BusinessLogic\SecureRoute
     */
    private function setUpAddOrEditNewsPage()
    {
        return $this->getControllerCollection()->match('/addOrEditNews/{id}', function (Request $request, Application $app, $id) {
            $requestType = $request->getMethod();
            if ($requestType == 'POST') {
                if (!empty($id)) {
                    $news = NewsQuery::create()
                        ->filterByUniqueId($id)
                        ->findOne();
                } else {
                    $news = new News();
                }

                $news->setTitle($request->get('title'));
                $news->setDescription($request->get('description'));
                $news->save();

                return $app->redirect('/admin/addOrEditNews' . $id);
            }

            $news = new News();
            $pageTitle = self::PAGE_TITLE_ADD_NEWS;

            if (!empty($id)) {
                $pageTitle = self::PAGE_TITLE_EDIT_NEWS;
                $news = NewsQuery::create()
                ->filterByUniqueId($id)
                ->findOne();
            }

            return $app['twig']->render("admin-index.html", array(
                'pageTitle' => $pageTitle,
                'activeMenuItem' => 'addOrEditNews',
                'username' => $this->getUsername($app),
                'pageContent' => $app['twig']->render("add-edit-news.html", [
                    'news' => $news
                ])
            ));
        })->value('id', '');
    }

    /**
     * @return \Silex\Controller|\BusinessLogic\SecureRoute
     */
    private function setUpNewsListPage()
    {
        return $this->getControllerCollection()->get('/newsList', function (Application $app) {

            $pageTitle = self::PAGE_TITLE_NEWS_LIST;

            return $app['twig']->render("admin-index.html", array(
                'pageTitle' => $pageTitle,
                'activeMenuItem' => 'newsList',
                'username' => $this->getUsername($app),
                'pageContent' => $app['twig']->render("view-news.html", [
                    'newsList' => NewsQuery::create()->orderByUpdatedAt(Criteria::DESC)->find(),
                ])
            ));
        });
    }


    /**
     * @return \Silex\Controller|\BusinessLogic\SecureRoute
     */
    private function setUpDeleteNewsPage()
    {
        return $this->getControllerCollection()->match('/deleteNews/{id}', function (Application $app, $id) {
            NewsQuery::create()
                ->filterByUniqueId($id)
                ->delete();

            return $app->redirect("/admin/newsList");
        });
    }
}
