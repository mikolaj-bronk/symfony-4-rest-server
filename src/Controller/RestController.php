<?php

namespace App\Controller;

use App\{
    Entity\Items,
    Interfaces\IRestController
};
use Symfony\Component\HttpFoundation\{
    Response,
    JsonResponse,
    Request
};

use App\Repository\ItemsRepository;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RestController extends Controller implements IRestController
{
    /**
     * Returns all items [GET]
     * @Route("/items", name="items_return")
     * @FOSRest\Get("/items")
     */
    public function getAll()
    {
        $repository = $this->getDoctrine()->getRepository(Items::class);
        $items = $repository->findAll();
        return new JsonResponse($items, Response::HTTP_OK);
    }

    /**
     * Returns items where amount is greater than zero [GET]
     * @Route("/items/notfound", name="items_not_found_return")
     * @FOSRest\Get("/items/notfound")
     */
    public function getItemsWhereAmountIsEqualToZero()
    {
        $repository = $this->getDoctrine()->getRepository(Items::class);
        $items = $repository->findItemsWhereAmountIsEqualToZero();
        return new JsonResponse($items, Response::HTTP_OK);
    }

    /**
     * Display items where amount is greater than zero [GET]
     * @Route("/items/found", name="items_found_return")
     * @FOSRest\Get("/items/found")
     */
    public function getItemsWhereAmountIsGreaterThanZero()
    {
        $repository = $this->getDoctrine()->getRepository(Items::class);
        $items = $repository->findItemsWhereAmountIsGreaterThan(0);
        return new JsonResponse($items, Response::HTTP_OK);
    }

    /**
     * Display items where amount is greater than five [GET]
     * @Route("/items/foundfive", name="items_amount_more_than_five_found_return")
     * @FOSRest\Get("/items/foundfive")
     */
    public function getItemsWhereAmountIsGreaterThanFive()
    {
        $repository = $this->getDoctrine()->getRepository(Items::class);
        $items = $repository->findItemsWhereAmountIsGreaterThan(5);
        return new JsonResponse($items, Response::HTTP_OK);
    }

    /**
     * Create item [POST]
     * @Route("/add", name="items_create")
     * @FOSRest\Post("/add")
     */
    public function createItem(Request $request)
    {
        $item = new Items();
        $item->setName($request->get('name'));
        $item->setAmount($request->get('amount'));
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($item);
        $manager->flush();
        return new Response('added', Response::HTTP_CREATED);
    }

    /**
     * Delete item [DELETE]
     * @Route("/delete", name="items_delete")
     * @FOSRest\Delete("/delete")
     */
    public function delete(Request $request)
    {
        $item = $this->getDoctrine()
            ->getRepository(Items::class)
            ->findOneById($request->get('id'));

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($item);
        $manager->flush();

        return new Response('deleted', Response::HTTP_OK);
    }
}
