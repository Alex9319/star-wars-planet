<?php

namespace App\Service\Planets;

use App\Service\Utils\validateService;
use Doctrine\Persistence\ManagerRegistry;

class planetService
{

    /**
     * Function to get all information of a planet
     *
     * @param int $idPlanet
     * @return array
     */
    function getPlanet(int $idPlanet, ManagerRegistry $doctrine){
        $validateService = new validateService();

        $validatePlanet = $validateService->validateGetPlanet($idPlanet);

        if($validatePlanet['status'] == false){
            return $validatePlanet;
        }

        $details = new getDataPlanetService();          
        $dataPlanet = $details->getDataPlanet($idPlanet, $doctrine);

        if(!$dataPlanet['status'] || !isset($dataPlanet['data']) || empty($dataPlanet['data']) ){
            return $dataPlanet;
        }
        
        $formatDataService = new formatDataPlanetService();
        $response = $formatDataService->formatData($dataPlanet['data'], $idPlanet);       

        return $response;
    }

    /**
     * Function to set a new planet
     *
     * @param string $inputParams
     * @return array
     */
    function setPlanet($inputParams, $doctrine){
        $validatorService = new validateService();
        $validate = $validatorService->validateSetPlanet($inputParams, $doctrine);
        
        if($validate['status'] == false){
            return $validate;
        }

        $em = $doctrine->getManager();
        $dataService = new setDataPlanetService($em);
        $newPlanet = $dataService->setPlanetData($inputParams);

        if($newPlanet['status'] == false){
            return $newPlanet;
        }

        $response = $this->getPlanet($newPlanet['data']['id'], $doctrine);

        return $response;
    }

}