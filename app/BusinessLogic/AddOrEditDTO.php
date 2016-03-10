<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 3/10/2016
 * Time: 9:07 PM
 */

namespace BusinessLogic;

class AddOrEditDTO
{
    private $title;
    private $estimatedValue;
    private $location;
    private $documentation;
    private $adNumber;
    private $publishDate;
    private $gainer;
    private $contractType;
    private $fundingType;
    private $contractSubject;
    private $offerEndDate;
    private $applyMode;
    private $contractPeriod;
    private $participationWarranty;
    private $participationConditions;
    private $professionalAbility;
    private $averageTurnover;
    private $cashFlow;
    private $similarExperience;
    private $keyPersonnel;
    private $equipment;
    private $qualityAssurance;
    private $additionalInformation;
    private $config;

    public function __construct()
    {
        $this->config = array(
            "title" => "Titlu",
            "estimated_value" => "Valoare estimata",
            "location" => "Locatia",
            "documentation" => "Documentatie",
            "ad_number" => "Numar anunt",
            "publish_date" => 'Data Publicare',
            "gainer" => "Beneficiar",
            "contract_type" => "Obiectul contractului",
            "funding_type" => "Tipul de finantare",
            "contract_subject" => 'Obiectul contractului',
            "offer_end_date" => "Data limita de depunere a ofertei",
            "apply_mode" => "Conditii de participare",
            "contract_period" => "Durata contractului",
            "participation_warranty" => "Garantie de participare",
            "participation_conditions" => "Conditii de participare",
            "professional_ability" => "Capacitate de exercitare a activitatii profesionale",
            "average_turnover" => "Cifra medie de afaceri in ultimii 3 ani",
            "cash_flow" => "Cash-flow",
            "similar_experience" => "Experienta similara",
            "key_personnel" => "Personal-cheie",
            "equipment" => "Utilaje/echipamente",
            "quality_assurance" => "Standarde de asigurare a calitatii si de protectia mediului",
            "additional_information" => "Important !!!",
        );
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getEstimatedValue()
    {
        return $this->estimatedValue;
    }

    /**
     * @param mixed $estimatedValue
     */
    public function setEstimatedValue($estimatedValue)
    {
        $this->estimatedValue = $estimatedValue;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * @param mixed $documentation
     */
    public function setDocumentation($documentation)
    {
        $this->documentation = $documentation;
    }

    /**
     * @return mixed
     */
    public function getAdNumber()
    {
        return $this->adNumber;
    }

    /**
     * @param mixed $adNumber
     */
    public function setAdNumber($adNumber)
    {
        $this->adNumber = $adNumber;
    }

    /**
     * @return mixed
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * @param mixed $publishDate
     */
    public function setPublishDate($publishDate)
    {
        $this->publishDate = $publishDate;
    }

    /**
     * @return mixed
     */
    public function getGainer()
    {
        return $this->gainer;
    }

    /**
     * @param mixed $gainer
     */
    public function setGainer($gainer)
    {
        $this->gainer = $gainer;
    }

    /**
     * @return mixed
     */
    public function getContractType()
    {
        return $this->contractType;
    }

    /**
     * @param mixed $contractType
     */
    public function setContractType($contractType)
    {
        $this->contractType = $contractType;
    }

    /**
     * @return mixed
     */
    public function getFundingType()
    {
        return $this->fundingType;
    }

    /**
     * @param mixed $fundingType
     */
    public function setFundingType($fundingType)
    {
        $this->fundingType = $fundingType;
    }

    /**
     * @return mixed
     */
    public function getContractSubject()
    {
        return $this->contractSubject;
    }

    /**
     * @param mixed $contractSubject
     */
    public function setContractSubject($contractSubject)
    {
        $this->contractSubject = $contractSubject;
    }

    /**
     * @return mixed
     */
    public function getOfferEndDate()
    {
        return $this->offerEndDate;
    }

    /**
     * @param mixed $offerEndDate
     */
    public function setOfferEndDate($offerEndDate)
    {
        $this->offerEndDate = $offerEndDate;
    }

    /**
     * @return mixed
     */
    public function getApplyMode()
    {
        return $this->applyMode;
    }

    /**
     * @param mixed $applyMode
     */
    public function setApplyMode($applyMode)
    {
        $this->applyMode = $applyMode;
    }

    /**
     * @return mixed
     */
    public function getContractPeriod()
    {
        return $this->contractPeriod;
    }

    /**
     * @param mixed $contractPeriod
     */
    public function setContractPeriod($contractPeriod)
    {
        $this->contractPeriod = $contractPeriod;
    }

    /**
     * @return mixed
     */
    public function getParticipationWarranty()
    {
        return $this->participationWarranty;
    }

    /**
     * @param mixed $participationWarranty
     */
    public function setParticipationWarranty($participationWarranty)
    {
        $this->participationWarranty = $participationWarranty;
    }

    /**
     * @return mixed
     */
    public function getParticipationConditions()
    {
        return $this->participationConditions;
    }

    /**
     * @param mixed $participationConditions
     */
    public function setParticipationConditions($participationConditions)
    {
        $this->participationConditions = $participationConditions;
    }

    /**
     * @return mixed
     */
    public function getProfessionalAbility()
    {
        return $this->professionalAbility;
    }

    /**
     * @param mixed $professionalAbility
     */
    public function setProfessionalAbility($professionalAbility)
    {
        $this->professionalAbility = $professionalAbility;
    }

    /**
     * @return mixed
     */
    public function getAverageTurnover()
    {
        return $this->averageTurnover;
    }

    /**
     * @param mixed $averageTurnover
     */
    public function setAverageTurnover($averageTurnover)
    {
        $this->averageTurnover = $averageTurnover;
    }

    /**
     * @return mixed
     */
    public function getCashFlow()
    {
        return $this->cashFlow;
    }

    /**
     * @param mixed $cashFlow
     */
    public function setCashFlow($cashFlow)
    {
        $this->cashFlow = $cashFlow;
    }

    /**
     * @return mixed
     */
    public function getSimilarExperience()
    {
        return $this->similarExperience;
    }

    /**
     * @param mixed $similarExperience
     */
    public function setSimilarExperience($similarExperience)
    {
        $this->similarExperience = $similarExperience;
    }

    /**
     * @return mixed
     */
    public function getKeyPersonnel()
    {
        return $this->keyPersonnel;
    }

    /**
     * @param mixed $keyPersonnel
     */
    public function setKeyPersonnel($keyPersonnel)
    {
        $this->keyPersonnel = $keyPersonnel;
    }

    /**
     * @return mixed
     */
    public function getEquipment()
    {
        return $this->equipment;
    }

    /**
     * @param mixed $equipment
     */
    public function setEquipment($equipment)
    {
        $this->equipment = $equipment;
    }

    /**
     * @return mixed
     */
    public function getQualityAssurance()
    {
        return $this->qualityAssurance;
    }

    /**
     * @param mixed $qualityAssurance
     */
    public function setQualityAssurance($qualityAssurance)
    {
        $this->qualityAssurance = $qualityAssurance;
    }

    /**
     * @return mixed
     */
    public function getAdditionalInformation()
    {
        return $this->additionalInformation;
    }

    /**
     * @param mixed $additionalInformation
     */
    public function setAdditionalInformation($additionalInformation)
    {
        $this->additionalInformation = $additionalInformation;
    }


}