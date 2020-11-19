<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/localisation", name="location_")
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
     * @Route("/{id}", name="")
     * @param Location $location
     * @param PropertyRepository $propertyRepository
     * @return Response
     */
    public function showProperty(Location $location, PropertyRepository $propertyRepository): Response
    {
        $properties = $propertyRepository->findBy(['location' => $location]);
        return $this->render('location/showProperty.html.twig', [
            'properties' => $properties,
        ]);
    }
}
