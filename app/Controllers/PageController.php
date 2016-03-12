<?php

namespace Controllers;

use Database\Model\Auction;
use Database\Model\AuctionQuery;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;

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
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $this->homePage($controllers);
        $this->addOrEditPage($controllers);

        return $controllers;
    }


    private function homePage(ControllerCollection $controllers)
    {
        $controllers->get('/', function (Application $app) {
            return $app['twig']->render("index.html", array(
                'pageTitle' => 'Acasa'
            ));
        });
    }


    private function addOrEditPage(ControllerCollection $controllers)
    {
        $controllers->match('/addOrEdit/{id}', function (Application $app, $id) {
            /** @var Request $request */
            $request = $app['request'];

            $requestType = $request->getMethod();
            if ($requestType == 'POST') {

                if (!empty($id)) {
                    $auctionQuery = new AuctionQuery();
                    $auction = $auctionQuery->filterById($id)->findOne();
                } else {
                    $auction = new Auction();
                }

                $title                   = $request->get("Title");
                $estimatedValue          = $request->get("EstimatedValue");
                $location                = $request->get("Location");
                $documentation           = $request->get("Documentation");
                $adNumber                = $request->get("AdNumber");
                $publishDate             = $request->get("PublishDate");
                $gainer                  = $request->get("Gainer");
                $contractType            = $request->get("ContractType");
                $fundingType             = $request->get("FundingType");
                $contractSubject         = $request->get("ContractSubject");
                $offerEndDate            = $request->get("OfferEndDate");
                $applyMode               = $request->get("ApplyMode");
                $contractPeriod          = $request->get("ContractPeriod");
                $participationWarranty   = $request->get("ParticipationWarranty");
                $participationConditions = $request->get("ParticipationConditions");
                $professionalAbility     = $request->get("ProfessionalAbility");
                $averageTurnover         = $request->get("AverageTurnover");
                $cashFlow                = $request->get("CashFlow");
                $similarExperience       = $request->get("SimilarExperience");
                $keyPersonnel            = $request->get("KeyPersonnel");
                $equipment               = $request->get("Equipment");
                $qualityAssurance        = $request->get("QualityAssurance");
                $additionalInformation   = $request->get("AdditionalInformation");

                $auction
                    ->setTitle($title)
                    ->setLocation($location)
                    ->setEstimatedValue($estimatedValue)
                    ->setDocumentation($documentation)
                    ->setAdNumber($adNumber)
                    ->setGainer($gainer)
                    ->setFundingType($fundingType)
                    ->setContractSubject($contractSubject)
                    ->setOfferEndDate($offerEndDate)
                    ->setContractPeriod($contractPeriod)
                    ->setParticipationWarranty($participationWarranty)
                    ->setParticipationConditions($participationConditions)
                    ->setProfessionalAbility($professionalAbility)
                    ->setAverageTurnover($averageTurnover)
                    ->setCashFlow($cashFlow)
                    ->setSimilarExperience($similarExperience)
                    ->setKeyPersonnel($keyPersonnel)
                    ->setEquipment($equipment)
                    ->setQualityAssurance($qualityAssurance)
                    ->setContractType($contractType)
                    ->setPublishDate($publishDate)
                    ->setApplyMode($applyMode)
                    ->setAdditionalInformation($additionalInformation)
                    ->save();
                $id = $auction->getId();
            }

            $auction   = array();
            $pageTitle = 'Adauga Licitatie';

            if (!empty($id)) {
                $pageTitle = "Editeaza Licitatie";

                if (empty($auction)) {
                    $auctionQuery = new AuctionQuery();
                    $auctionQuery->filterById($id);
                    $auction = $auctionQuery->findOne()->toArray();
                }
            }

            return $app['twig']->render("index.html", array(
                'pageTitle' => $pageTitle,
                'pageContent' => $app['twig']->render("add-edit-auction.html", [
                    'inputArray' => $app['config']['addOrEditSection'],
                    'auctionList' => $auction,
                ])
            ));
        })->value('id', '');
    }
}
