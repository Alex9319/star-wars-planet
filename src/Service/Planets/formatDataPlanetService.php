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

        if(is_array($dataInput['films'])){
            $films = count($dataInput['films']);
        }else{
            $films = $dataInput['films'];
        }

        $data = [
            'id'              => $idPlanet,
            'name'            => $dataInput['name'],
            'rotation_period' => $dataInput['rotation_period'],
            'orbital_period'  => $dataInput['orbital_period'],
            'diameter'        => $dataInput['diameter'],
            'films_count'     => $films,
            'created'         => date("c", strtotime($dataInput['created'])),
            'edited'          => date("c", strtotime($dataInput['edited'])),
            'url'             => $dataInput['url']
        ];
        
        $utilService = new utilService();
        $response = $utilService->sendResponse(true, $data, 200);        
        
        return $response;
    }

}