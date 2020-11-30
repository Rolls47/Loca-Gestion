<?php

namespace App\Controller;

use App\Entity\Location;
use App\Entity\LocationAccounting;
use App\Form\LocationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route ("/new", name="new")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($location);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('location/new.html.twig', [
            'form' => $form->createView(),
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
        $labelRep = $em->getRepository('App:Label');

        $properties = $propertyRep->findBy(['location' => $location]);

        $sumPropertiesByLocation = ($propertyRep->sumPropertiesByLocation($location->getId())[1] / 100);
        $sumByLocation = ($locationRep->sumByLocation($location->getId())[1] / 100);

        $benefit = ($sumPropertiesByLocation - $sumByLocation);

        foreach ($properties as $property) {
            $localisation = $property->getLocation();
            $countOfProperty = count($localisation->getProperties());
        }

    //Water Sum
        $water = $labelRep->findBy(['name' => 'Eau']);
        $waterId = $water[0]->getId();
        $sumLocationWater = ($locationRep->sumByLabelPerLocation($location->getId(), $waterId)[1] / 100);
        $sumPropertiesWater = ($propertyRep->sumByLabelPerProperties($location->getId(), $waterId)[1] / 100);

    //Electricity Sum
        $electricity = $labelRep->findBy(['name' => 'Électricité']);
        $electricityId = $electricity[0]->getId();
        $sumLocationElectricity = ($locationRep->sumByLabelPerLocation($location->getId(), $electricityId)[1] / 100);
        $sumPropertiesElectricity = ($propertyRep->sumByLabelPerProperties($location->getId(), $electricityId)[1] / 100);



        return $this->render('location/showProperty.html.twig', [
            'properties' => $properties,
            'location' => $localisation,
            'countOfProperty' => $countOfProperty,
            'sumPropertiesByLocation' => $sumPropertiesByLocation,
            'sumByLocation' => $sumByLocation,
            'benefit' => $benefit,
            'sumLocationWater' => $sumLocationWater,
            'sumLocationElec' => $sumLocationElectricity,
            'sumPropertiesWater' => $sumPropertiesWater,
            'sumPropertiesElec' => $sumPropertiesElectricity
        ]);
    }

}
