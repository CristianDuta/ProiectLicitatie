<?php
namespace BusinessLogic;

use Database\Model\Auction;
use Database\Model\AuctionQuery;
use Symfony\Component\HttpFoundation\Request;

class SaveAuctionProcess
{
    /** @var int */
    private $auctionId;

    /** @var Request */
    private $request;


    public function execute()
    {
        if (!empty($this->auctionId)) {
            $auctionQuery = new AuctionQuery();
            $auction = $auctionQuery->filterByUniqueId($this->auctionId)->findOne();
        } else {
            $auction = new Auction();
        }

        $title                   = $this->request->get("Title");
        $estimatedValue          = $this->request->get("EstimatedValue");
        $location                = $this->request->get("Location");
        $documentation           = $this->request->get("Documentation");
        $adNumber                = $this->request->get("AdNumber");
        $publishDate             = $this->request->get("PublishDate");
        $gainer                  = $this->request->get("Gainer");
        $contractType            = $this->request->get("ContractType");
        $fundingType             = $this->request->get("FundingType");
        $contractSubject         = $this->request->get("ContractSubject");
        $offerEndDate            = $this->request->get("OfferEndDate");
        $applyMode               = $this->request->get("ApplyMode");
        $contractPeriod          = $this->request->get("ContractPeriod");
        $participationWarranty   = $this->request->get("ParticipationWarranty");
        $participationConditions = $this->request->get("ParticipationConditions");
        $professionalAbility     = $this->request->get("ProfessionalAbility");
        $averageTurnover         = $this->request->get("AverageTurnover");
        $cashFlow                = $this->request->get("CashFlow");
        $similarExperience       = $this->request->get("SimilarExperience");
        $keyPersonnel            = $this->request->get("KeyPersonnel");
        $equipment               = $this->request->get("Equipment");
        $qualityAssurance        = $this->request->get("QualityAssurance");
        $additionalInformation   = $this->request->get("AdditionalInformation");

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
        return $auction->getId();
    }



    /**
     * @param Request $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }



    /**
     * @param int $auctionId
     */
    public function setAuctionId($auctionId)
    {
        $this->auctionId = $auctionId;
    }
}
