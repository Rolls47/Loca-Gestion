<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationAccountingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Column\DateTimeColumn;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comptabilite", name="locationAccounting_")
 **/
class LocationAccountingController extends AbstractController
{
    /**
     * @Route("/{slug}", name="show")
     * @param EntityManagerInterface $em
     * @param Location $location
     * @param Request $request
     * @param DataTableFactory $dataTableFactory
     * @return Response
     */
    public function show(EntityManagerInterface $em, Location $location, Request $request, DataTableFactory $dataTableFactory): Response
    {
        $locationsAccounting = $em->getRepository('App:LocationAccounting')->findBy(
            ['location' => $location],
            ['date' => 'ASC']
        );

        $locations = $em->getRepository('App:LocationAccounting')->findBy(['location' => $location]);

        foreach ($locations as $data){
            $localisation = $data->getLocation()->getName();
        }

        $results = [];
        foreach ($locationsAccounting as $locationAccounting) {
            $results[] = [
                'id' => $locationAccounting->getId(),
                'label' => $locationAccounting->getLabel(),
                'operationType' => $locationAccounting->getOperationType(),
                'value' => ($locationAccounting->getValue() / 100),
                'date' => $locationAccounting->getDate(),
                'comment' => $locationAccounting->getComment(),
            ];
        }

        $datatable = $dataTableFactory->create()
            ->add('id', TextColumn::class, [
                'label' => 'id.'
            ])
            ->add('label', TextColumn::class, [
                'label' => 'label',
                'orderable' => true
            ])
            ->add('operationType', TextColumn::class, [
                'label' => 'Type d\'opération',
                'orderable' => true
            ])
            ->add('value', TextColumn::class, [
                'label' => 'Montant',
                'orderable' => true
            ])
            ->add('date', DateTimeColumn::class, [
                'format' => 'd-m-Y',
                'label' => 'Date',
                'orderable' => true
            ])
            ->add('comment', TextColumn::class, [
                'label' => 'Commentaire',
            ]);


        $datatable->createAdapter(ArrayAdapter::class, $results);
        $datatable->handleRequest($request);

        if ($datatable->isCallback()) {
            return $datatable->getResponse();
        }
        return $this->render('location_accounting/show.html.twig', [
            'datatable' => $datatable,
            'location' => $localisation,
        ]);
    }
}
