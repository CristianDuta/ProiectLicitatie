<?php

namespace Controllers;

use BusinessLogic\GetAuctionProcess;
use BusinessLogic\SaveAuctionProcess;
use Database\Model\Auction;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\User;
use BusinessLogic\UserRegistrationProcess;

class PageController extends AbstractAppController
{
    const PAGE_TITLE_HOME = 'Acasa';
    const PAGE_TITLE_ADD_AUCTION = 'Adauga Licitatie';
    const PAGE_TITLE_VIEW_DETAILS_AUCTION = 'Detalii Licitatie';
    const PAGE_TITLE_EDIT_AUCTION = 'Editeaza Licitatie';
    const PAGE_TITLE_VIEW_AUCTION_LIST = 'Vizualizare Licitatii';
    const PAGE_TITLE_VIEW_AUCTION = 'Vizualizare Licitatie';


    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $this->homePage($controllers);
        $this->addOrEditPage($controllers);
        $this->viewDetailsPage($controllers);
        $this->viewPage($controllers);
        $this->registerUser($controllers);

        return $controllers;
    }



    private function homePage(ControllerCollection $controllers)
    {
        $controllers->get('/', function (Application $app, Request $request) {
            return $app['twig']->render("index.html", array(
                'pageTitle' => self::PAGE_TITLE_HOME,
                'activeMenuItem' => 'home',
                'error' => $app['security.last_error']($request),
                'username' => $this->getUser($app),
            ));
        });
    }



    private function viewDetailsPage(ControllerCollection $controllers)
    {
        $controllers->match('/viewDetails/{id}', function (Application $app, $id) {
            /** @var Request $request */
            $request = $app['request'];

            $requestType = $request->getMethod();
            if ($requestType == 'POST') {
                $saveAuctionProcess = new SaveAuctionProcess();
                $saveAuctionProcess->setAuctionId($id);
                $saveAuctionProcess->setRequest($request);
                $id = $saveAuctionProcess->execute();
                $this->redirect('/viewDetails/'.$id);
            }

            $auction   = array();
            $pageTitle = self::PAGE_TITLE_ADD_AUCTION;

            if (!empty($id)) {
                $pageTitle = self::PAGE_TITLE_VIEW_DETAILS_AUCTION;

                if (empty($auction)) {
                    $getAuctionProcess = new GetAuctionProcess();
                    $auction = $getAuctionProcess->getOne($id)->toArray();
                }
            }

            return $app['twig']->render("index.html", array(
                'pageTitle' => $pageTitle,
                'activeMenuItem' => 'viewDetails',
                'username' => $this->getUser($app),
                'pageContent' => $app['twig']->render("view-details.html", [
                    'inputArray' => $app['config']['addOrEditSection'],
                    'auctionList' => $auction,
                ])
            ));
        })->value('id', '');
    }



    private function addOrEditPage(ControllerCollection $controllers)
    {
        $controllers->match('/addOrEdit/{id}', function (Application $app, $id) {
            /** @var Request $request */
            $request = $app['request'];

            $requestType = $request->getMethod();
            if ($requestType == 'POST') {
                $saveAuctionProcess = new SaveAuctionProcess();
                $saveAuctionProcess->setAuctionId($id);
                $saveAuctionProcess->setRequest($request);
                $id = $saveAuctionProcess->execute();
                $this->redirect('/addOrEdit/'.$id);
            }

            $auction   = array();
            $pageTitle = self::PAGE_TITLE_ADD_AUCTION;

            if (!empty($id)) {
                $pageTitle = self::PAGE_TITLE_EDIT_AUCTION;

                if (empty($auction)) {
                    $getAuctionProcess = new GetAuctionProcess();
                    $auction = $getAuctionProcess->getOne($id)->toArray();
                }
            }

            return $app['twig']->render("index.html", array(
                'pageTitle' => $pageTitle,
                'activeMenuItem' => 'addOrEdit',
                'username' => $this->getUser($app),
                'pageContent' => $app['twig']->render("add-edit-auction.html", [
                    'inputArray' => $app['config']['addOrEditSection'],
                    'auctionList' => $auction,
                ])
            ));
        })->value('id', '');
    }



    private function viewPage(ControllerCollection $controllers)
    {
        $controllers->get('/view', function (Application $app) {

            $pageTitle = self::PAGE_TITLE_VIEW_AUCTION_LIST;

            $getAuctionProcess = new GetAuctionProcess();
            $auctionList = $getAuctionProcess->getAll();

            $results = array();
            /** @var Auction $auction */
            foreach($auctionList as $auction)
            {
                $result = array();
                $result['location'] = $auction->getLocation();
                $result['title'] = $auction->getTitle();
                $result['estimated_value'] = $auction->getEstimatedValue();
                $result['publish_date'] = $auction->getPublishDate("d.m.Y");
                $result['id'] = $auction->getId();

                $results[] = $result;
            }

            return $app['twig']->render("index.html", array(
                'pageTitle' => $pageTitle,
                'activeMenuItem' => 'view',
                'username' => $this->getUser($app),
                'pageContent' => $app['twig']->render("view.html", [
                    'auctionList' => $results,
                ])
            ));
        });
    }



    private function registerUser(ControllerCollection $controllers)
    {
        $controllers->post('/registerUser', function (Application $app, Request $request) {
            $parameterList = $request->request->all();
            $userRegistrationProcess = new UserRegistrationProcess(
                $parameterList['email'],
                $app['security.encoder.digest']->encodePassword($parameterList['password'], ''),
                $parameterList['firstName'],
                $parameterList['lastName'],
                $parameterList['phoneNumber'],
                $parameterList['newsOption']
            );
            $userRegistrationProcess->execute();

            $this->redirect("/");
        });
    }



    private function redirect($newURL)
    {
        header('Location: '.$newURL);
        exit(0);
    }



    /**
     * @param Application $app
     * @return string
     */
    private function getUser($app)
    {
        /** @var UsernamePasswordToken $token */
        $token = $app['security.token_storage']->getToken();

        if (!$token instanceof UsernamePasswordToken) {
            return null;
        }

        /** @var User $user */
        $user = $token->getUser();

        if (!$user instanceof User) {
            return null;
        }

        return $user->getUsername();
    }
}
