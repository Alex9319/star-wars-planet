<?php

namespace App\Service\Planets;

use App\Entity\Planets;
use App\Service\Utils\utilService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\Json;

class setDataPlanetService
{

    private $em = null;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Function from set all data from a planet
     *
     * @param string $inputParams
     * @return array
     */
    public function setPlanetData(string $inputParams){

        $utilService = new utilService();

        $decodedPanet = json_decode($inputParams);

        $planet = new Planets();
        $planet->setId($decodedPanet->id);
        $planet->setName($decodedPanet->name);
        $planet->setRotationPeriod($decodedPanet->rotation_period);
        $planet->setOrbitalPeriod($decodedPanet->orbital_period);
        $planet->setDiameter($decodedPanet->diameter);
        $planet->setFilmsCount(0);
        $planet->setCreated(new \DateTime());
        $planet->setEdited(new \DateTime());
        $planet->setUrl('');


        $this->em->persist($planet);
        $this->em->flush();

        $data = [
            'id' => $planet->getId()
        ];
        
        $response = $utilService->sendResponse(true, $data, 200);

        return $response;

    }
}