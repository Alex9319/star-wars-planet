<?php

namespace App\Controller;

use App\Service\Planets\planetService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/planets/{idPlanet}', name: 'api_get_planets',  methods: "GET")]
    public function index(string $idPlanet, ManagerRegistry $doctrine): JsonResponse
    {
        $planetService = new planetService();
        $response = $planetService->getPlanet($idPlanet, $doctrine);

        if(isset($response['error'])){
            return $this->json($response, $response['statusCode']);
        }else{
            return $this->json($response['data'], $response['statusCode']);
        }
    }

    #[Route('/api/planets', name: 'app_set_planets', methods: "POST")]
    public function setPost(HttpFoundationRequest $request, ManagerRegistry $doctrine): JsonResponse
    {

        $planetService = new planetService();
        $response = $planetService->setPlanet($request->getContent(), $doctrine);

        if(isset($response['error'])){
            return $this->json($response, $response['statusCode']);
        }else{
            return $this->json($response['data'], $response['statusCode']);
        }
    }
}
