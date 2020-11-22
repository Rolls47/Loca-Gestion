<?php

namespace App\Controller;

use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/localisations", name="location_")
 */
class LocationController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function index(EntityManagerInterface $em): Response
    {
        $locations = $em->getRepository('App:Location')->findAll();


        return $this->render('location/index.html.twig', [
            'locations' => $locations,
        ]);
    }

    /**
     * @Route("/{slug}", name="showProperty")
     * @param Location $location
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function showProperty(Location $location, EntityManagerInterface $em): Response
    {
        $propertyRep = $em->getRepository('App:Property');
        $locationRep = $em->getRepository('App:Location');

        $properties = $propertyRep->findBy(['location' => $location]);

        $sumPropertiesByLocation = ($propertyRep->sumPropertiesByLocation($location->getId())[1] / 100);

        $sumByLocation = ($locationRep->sumByLocation($location->getId())[1] / 100);

        $benefit = ($sumPropertiesByLocation - $sumByLocation);

        foreach ($properties as $property) {
            $localisation = $property->getLocation();
            $countOfProperty = count($localisation->getProperties());
        }

        return $this->render('location/showProperty.html.twig', [
            'properties' => $properties,
            'location' => $localisation,
            'countOfProperty' => $countOfProperty,
            'sumPropertiesByLocation' => $sumPropertiesByLocation,
            'sumByLocation' => $sumByLocation,
            'benefit' => $benefit,
        ]);
    }
}
