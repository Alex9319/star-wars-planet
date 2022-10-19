<?php

namespace App\Service\Planets;

use App\Service\Utils\utilService;
use Symfony\Component\HttpClient\CurlHttpClient;

class getDataPlanetService
{
    /**
     * Function from get all data from a url
     *
     * @param int $planetId
     * @return array
     */
    public function getData(int $planetId){

        $utilService = new utilService();
        $client = new CurlHttpClient();

        $response = $client->request('GET', 'https://swapi.dev/api/planets/'.$planetId);

        $statusCode = $response->getStatusCode();
        if($statusCode == 200){
            $content = $response->getContent();

            $response = $utilService->sendResponse(true, json_decode($content, true), $statusCode);
        }else{
            $response = $utilService->sendResponse(false, [], $statusCode, "This planet doesn't exist");
        }

        return $response;

    }
}