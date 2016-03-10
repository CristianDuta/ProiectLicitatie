<?php
namespace BusinessLogic;

use Database\Model\Auction;

class AddAuctionProcess
{
    public function __construct()
    {
    }

    public function execute()
    {
        $valuesList = array(
            "title"                    => "Executie lucrari pentru Obiectivul de investitie \"Locuinte pentru tineri,destinate inchirierii,judetul Suceava ,municipiul Suceava ,zona METRO,etapa II\"",
            "location"                 => "Municipiul Suceava",
            "estimated_value"          => "11 817 576,60 lei",
            "documentation"            => "www.e-licitatie.ro ,Sectiunea :cereri de oferta",
            "ad_number"                => "3385007/18.02.2016",
            "beneficiary"              => "Agentia Nationala pentru Locuinte",
            "type_of_funding"          => "Bugetul de stat",
            "contract_subject"         => "Lucrari de constructii constand in 80 unitati locative ,4 tronsoane ,regim de inaltime S+P+3E+M",
            "appliance_end_date"       => "2016-03-09",
            "contract_period"          => "24 luni",
            "participation_guarantee"  => "220 .000 lei",
            "participation_conditions" => "",
            "professional_ability"     => "In certificatul constatator emis de ONRC trebuie sa existe cod CAEN activ corespunzator obiectului contractului",
            "fiscal_value"             => "minim 22.000.000 lei",
            "cash_flow"                => "nu este cazul",
            "similar_experience"       => "un contract maxim doua executate in ultimii 5 ani a caror valoare  cumulata sa fie  minim 11.000.000 lei ",
            "key_personnel"            => "sef de santier, R.T.E ,CQ,",
            "machinery_or_equipment"   => "nu este cazul",
            "qa_standard"              => "Dovada certificarii ISO 9001 ,14001 pentru obiectul contractului",
        );

        $auction = new Auction();
        $auction->setTitle($valuesList['title'])
            ->setLocation($valuesList['location'])
            ->setEstimatedValue(($valuesList['estimated_value']))
            ->setDocumentation($valuesList['documentation'])
            ->setAdNumber($valuesList['ad_number'])
            ->setGainer($valuesList['beneficiary'])
            ->setFundingType($valuesList['type_of_funding'])
            ->setContractSubject($valuesList['contract_subject'])
            ->setOfferEndDate($valuesList['appliance_end_date'])
            ->setContractPeriod($valuesList['contract_period'])
            ->setParticipationWarranty($valuesList['participation_guarantee'])
            ->setParticipationConditions($valuesList['participation_conditions'])
            ->setProfessionalAbility($valuesList['professional_ability'])
            ->setAverageTurnover($valuesList['fiscal_value'])
            ->setCashFlow($valuesList['cash_flow'])
            ->setSimilarExperience($valuesList['similar_experience'])
            ->setKeyPersonnel($valuesList['key_personnel'])
            ->setEquipment($valuesList['machinery_or_equipment'])
            ->setQualityAssurance($valuesList['qa_standard'])
            ->setContractType("Lucrari")
            ->setPublishDate("18.02.2016")
            ->setFundingType("Bugetul de stat");

        $auction->save();
    }

}
