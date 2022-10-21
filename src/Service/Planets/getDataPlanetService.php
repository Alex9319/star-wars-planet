<?php

namespace App\Service\Planets;

use App\Entity\Planets;
use App\Service\Utils\utilService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpClient\CurlHttpClient;

class getDataPlanetService
{
    /**
     * Function from get all data from a url
     *
     * @param int $planetId
     * @return array
     */
    public function getDataPlanet(int $planetId, ManagerRegistry $doctrine){

        $response = $this->getDataPlanetORM($planetId, $doctrine);

        if($response['status'] == false){
            $response = $this->getDataPlanetAPI($planetId);
        }
        
        return $response;

    }

    /**
     * Function from get all data from a url
     *
     * @param int $planetId
     * @return array
     */
    public function getDataPlanetAPI(int $planetId){
        $utilService = new utilService();
        $client = new CurlHttpClient();

        $response = $client->request('GET', 'https://swapi.dev/api/planets/'.$planetId);

        $statusCode = $response->getStatusCode();
        if($statusCode != 200){
            $response = $utilService->sendResponse(false, [], $statusCode, "This planet doesn't exist");
            return $response;
        }

        $content = $response->getContent();

        $response = $utilService->sendResponse(true, json_decode($content, true), $statusCode);

        return $response;
    }

    /**
     * Function from get all data from ORM
     *
     * @param int $planetId
     * @return array
     */
    public function getDataPlanetORM(int $planetId, ManagerRegistry $doctrine){

        $utilService = new utilService();

        $em = $doctrine->getManager();
        $planet = $em->getRepository(Planets::class)->findByIdPlanet($planetId);
        
        if(count($planet) == 0 || !isset($planet[0])){
            $response = $utilService->sendResponse(false, [], 404, "This planet doesn't exist");
            return $response;
        }
        
        $response = $utilService->sendResponse(true, $planet[0], 200);

        return $response;

    }
}