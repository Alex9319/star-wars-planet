<?php

namespace App\Service\Planets;

use App\Service\Utils\utilService;
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
        $utilService = new utilService();

        // Validate idPlanet
        $validator = Validation::createValidator();
        $violations = $validator->validate($idPlanet, [
            new Type('digit', 'The value of idPlanet is not correct'),
            new NotBlank(),
            new Positive(null, 'The value of idPlanet is not correct'),
        ]);

        if (0 !== count($violations)) {
            // there are errors, now you can show them
            foreach ($violations as $violation) {
                $result['error'] = $violation->getMessage();
                $result = $utilService->sendResponse(false, [], 404, $violation->getMessage());        
                return $result;
            }
        }

        $details = new getDataPlanetService();          
        $dataPlanet = $details->getData($idPlanet);

        if(!$dataPlanet['status'] || !isset($dataPlanet['data']) || empty($dataPlanet['data']) ){
            return $dataPlanet;
        }
        
        $formatDataService = new formatDataPlanetService();
        $data = $formatDataService->formatData($dataPlanet['data'], $idPlanet);
        
        $result = $utilService->sendResponse($dataPlanet['status'], $data['data'], $dataPlanet['statusCode']);        

        return $result;
    }

}