<?php

namespace App\Service\Planets;

use App\Service\Utils\utilService;

class formatDataPlanetService
{

    /**
     * Function to format response from all information of a planet
     *
     * @param array $data
     * @return array
     */
    public function formatData($dataInput, $idPlanet){

        $data = [
            'id'              => $idPlanet,
            'name'            => $dataInput['name'],
            'rotation_period' => $dataInput['rotation_period'],
            'orbital_period'  => $dataInput['orbital_period'],
            'diameter'        => $dataInput['diameter'],
            'films_count'     => count($dataInput['films']),
            'created'         => $dataInput['created'],
            'edited'          => $dataInput['edited'],
            'url'             => $dataInput['url']
        ];
        
        $utilService = new utilService();
        $result = $utilService->sendResponse(true, $data, 200);        
        
        return $result;
    }

}