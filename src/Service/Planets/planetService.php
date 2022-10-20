<?php

namespace App\Service\Planets;

use App\Service\Utils\utilService;
use App\Service\Utils\Validate\validateService;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validation;

class planetService
{

    /**
     * Function to get all information of a planet
     *
     * @param int $idPlanet
     * @return array
     */
    function getPlanet($idPlanet){
        $validateService = new validateService();

        $validatePlanet = $validateService->validateGetPlanet($idPlanet);

        if($validatePlanet['status'] == false){
            return $validatePlanet;
        }

        $details = new getDataPlanetService();          
        $dataPlanet = $details->getDataPlanet($idPlanet);

        if(!$dataPlanet['status'] || !isset($dataPlanet['data']) || empty($dataPlanet['data']) ){
            return $dataPlanet;
        }
        
        $formatDataService = new formatDataPlanetService();
        $response = $formatDataService->formatData($dataPlanet['data'], $idPlanet);       

        return $response;
    }

}