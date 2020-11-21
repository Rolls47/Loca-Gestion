<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyAccountingRepository;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Column\DateTimeColumn;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/compta", name="accounting_")
 **/
class PropertyAccountingController extends AbstractController
{
    /**
     * @Route("/{slug}", name="show")
     * @param Property $property
     * @param PropertyAccountingRepository $accountingRepository
     * @param Request $request
     * @param DataTableFactory $dataTableFactory
     * @return Response
     */
    public function index(Property $property, PropertyAccountingRepository $accountingRepository, Request $request, DataTableFactory $dataTableFactory): Response
    {
        $propertiesAccounting = $accountingRepository->findBy(
            ['property' => $property],
            ['date' => 'ASC']
        );

        $results = [];
        foreach ($propertiesAccounting as $propertyAccounting) {
            $results[] = [
                'id' => $propertyAccounting->getId(),
                'label' => $propertyAccounting->getLabel(),
                'operationType' => $propertyAccounting->getOperationType(),
                'value' => ($propertyAccounting->getValue() / 100),
                'date' => $propertyAccounting->getDate(),
                'comment' => $propertyAccounting->getComment(),
                'property' => $propertyAccounting->getProperty(),
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
            ])
            ->add('property', TextColumn::class, [
                'label' => 'Propriétée',
                'orderable' => true
            ]);

        $datatable->createAdapter(ArrayAdapter::class, $results);
        $datatable->handleRequest($request);

        if ($datatable->isCallback()) {
            return $datatable->getResponse();
        }

        return $this->render('property_accounting/show.html.twig', [
            'datatable' => $datatable,
        ]);
    }
}
