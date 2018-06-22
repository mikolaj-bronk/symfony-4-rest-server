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
