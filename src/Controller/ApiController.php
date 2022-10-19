<?php

namespace App\Controller;

use App\Service\Planets\planetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/planets/{idPlanet}', name: 'api_get_planets',  methods: "GET")]
    public function index(string $idPlanet): JsonResponse
    {
        $planetDataService = new planetService();
        $response = $planetDataService->getPlanet($idPlanet);

        if(isset($response['error'])){
            return $this->json($response, $response['statusCode']);
        }else{
            return $this->json($response['data'], $response['statusCode']);
        }
    }
}
