<?php

namespace Controllers;

use BusinessLogic\AddAuctionProcess;
use Database\Model\Auction;
use Database\Model\AuctionQuery;
use Silex\Application;
use Silex\ControllerCollection;

class PageController extends AbstractAppController
{
    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function (Application $app) {
            return $app['twig']->render("index.html", array(
                'pageTitle' => 'Acasa'
            ));
        });


        $controllers->get('/addOrEdit/{id}', function (Application $app, $id) {

            $auctionList = array();
            $pageTitle = 'Adauga Licitatie';

            if (isset($id)) {
                $pageTitle = "Editeaza Licitatie";
                $auctionQuery = new AuctionQuery();
                $auctionQuery->filterById($id);
                $auctionList = $auctionQuery->findOne()->toArray();
            }

            return $app['twig']->render("index.html", array(
                'pageTitle' => $pageTitle,
                'pageContent' => $app['twig']->render("add-edit-auction.html", [
                    'inputArray' => $app['config']['addOrEditSection'],
                    'auctionList' => $auctionList,
                ])
            ));
        });

        $controllers->get('/view', function (Application $app) {

            $pageTitle = 'Vizualizare Licitatii';

            $auctionQuery = new AuctionQuery();
            $auctionList = $auctionQuery->find();

            $results = array();
            foreach($auctionList as $auction)
            {
                $result = array();
                $result['location'] = $auction->getLocation();
                $result['title'] = $auction->getTitle();
                $result['estimated_value'] = $auction->getEstimatedValue();
                $result['publish_date'] = $auction->getPublishDate("d.m.Y");

                $results[] = $result;
            }

            return $app['twig']->render("index.html", array(
                'pageTitle' => $pageTitle,
                'pageContent' => $app['twig']->render("view.html", [
                    'auctionList' => $results,
                ])
            ));
        });

        $controllers->get('/add', function (Application $app) {
            $addAuctionProcess = new AddAuctionProcess();
            $addAuctionProcess->execute();
        });


        return $controllers;
    }
}
