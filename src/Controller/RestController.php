<?php

namespace App\Controller;

use App\Entity\Items;
use App\Interfaces\IRestController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Interfaces\RestControllerInterface;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RestController extends Controller implements IRestController
{
    /**
     * Display all items [GET]
     * @Route("/items", name="items_display")
     * @FOSRest\Get("/items")
     */
    public function getAll()
    {
        $repository = $this->getDoctrine()->getRepository(Items::class);
        $items = $repository->findAll();
        return new JsonResponse($items, Response::HTTP_OK);
    }
}

