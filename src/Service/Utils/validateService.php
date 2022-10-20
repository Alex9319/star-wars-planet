<?php

namespace App\Service\Utils\Validate;

use App\Service\Planets\getDataPlanetService;
use App\Service\Utils\utilService;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validation;

class validateService
{

    /**
    * Function to validate all information of planet set
    *
    * @param string $params
    * @return array
    */
    function validateSetPlanet($params){

        $utilService = new utilService();
        $decoded = json_decode($params);

        // Validate name
        $validator = Validation::createValidator();
        $violations = $validator->validate($decoded->name, [
            new NotBlank(),
            new Length([
                'min' => 5, 
                'max' =>50,
                'minMessage' => 'The value of name it`s too short', 
                'maxMessage' => 'The value of name it`s too long'
            ]),
        ]);

        if (0 !== count($violations)) {
            // there are errors, now you can show them
            foreach ($violations as $violation) {
                $response = $utilService->sendResponse(false, [], 404, $violation->getMessage());
                return $response;
            }
        }
        // Validate id
        $validator = Validation::createValidator();
        $violations = $validator->validate($decoded->id, [
            new Type('digit', 'The value of id is not correct'),
            new NotBlank(),
            new Positive(null, 'The value of id is not correct'),
        ]);
        
        if (0 !== count($violations)) {
            // there are errors, now you can show them
            foreach ($violations as $violation) {
                $response = $utilService->sendResponse(false, [], 404, $violation->getMessage());
                return $response;
            }
        }
        
        $getDataPlanetService = new getDataPlanetService();
        $existPlanet = $getDataPlanetService->getDataPlanet($decoded->id);
        
        if($existPlanet['status'] == true){
            $response = $utilService->sendResponse(false, [], 404, 'The planet with id is '.$decoded->id.' now exist');
            return $response;
        }
        
        $response = $utilService->sendResponse(true, [], 200);
        return $response;
    }


    /**
    * Function to validate all information of planet get
    *
    * @param int $idPlanet
    * @return array
    */
    function validateGetPlanet($idPlanet){

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
                $response['error'] = $violation->getMessage();
                $response = $utilService->sendResponse(false, [], 404, $violation->getMessage());        
                return $response;
            }
        }
        
        $response = $utilService->sendResponse(true, [], 200);
        return $response;
    }

}