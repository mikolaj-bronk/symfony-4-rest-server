<?php

namespace App\Controller;

use App\Controller\Interfaces\RestInterface;
use App\Entity\Items;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\{
    Response,
    JsonResponse,
    Request
};

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as FOSRest;

class ItemsController extends Controller implements RestInterface
{
    private const SUCCESS_CREATED_ITEM = 'Item has successfully created';
    private const SUCCESS_DELETED_ITEM = 'Item has successfully deleted';
    private const SUCCESS_UPDATED_ITEM = 'Item has successfully updated';
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Items::class);
    }

    /**
     * Returns all items [GET]
     * @Route("/items", name="items_all")
     * @FOSRest\Get("/items")
     */
    public function getAll()
    {
        $items = $this->repository->findAll();

        return new JsonResponse($items, Response::HTTP_OK);
    }

    /**
     * Get one item [GET]
     * @Route("/items/{id}", name="items_one")
     * @FOSRest\Get("/items")
     */
    public function getOne(int $id)
    {

    }

    /**
     * Returns items where amount is equal to zero [GET]
     * @Route("/items/notfound", name="items_unavailable")
     * @FOSRest\Get("/items/notfound")
     */
    public function getUnavailable()
    {
        $items = $this->repository->findItemsWhere('=');

        return new JsonResponse($items, Response::HTTP_OK);
    }

    /**
     * Display items where amount is greater than zero [GET]
     * @Route("/items/found", name="items_available")
     * @FOSRest\Get("/items/found")
     */
    public function getAvailable()
    {
        $items = $this->repository->findItemsWhere('>', 0);

        return new JsonResponse($items, Response::HTTP_OK);
    }

    /**
     * Display items where amount is greater than five [GET]
     * @Route("/items/foundfive", name="items_greater_than_five")
     * @FOSRest\Get("/items/foundfive")
     */
    public function getGreaterThanFive()
    {
        $items = $this->repository->findItemsWhere('>', 5);

        return new JsonResponse($items, Response::HTTP_OK);
    }

    /**
     * Create item [POST]
     * @Route("/add", name="items_create")
     * @FOSRest\Post("/add")
     */
    public function create(Request $request)
    {
        $item = new Items();
        $item->setName($request->get('name'));
        $item->setAmount($request->get('amount'));
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($item);
        $manager->flush();

        return new Response(self::SUCCESS_CREATED_ITEM, Response::HTTP_CREATED);
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

        return new Response(self::SUCCESS_DELETED_ITEM, Response::HTTP_OK);
    }

    /**
     * Update item [PUT]
     * @Route("/update/{id}", name="items_update")
     * @FOSRest\Put("/update")
     */
    public function update(int $id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $item = $this->getDoctrine()
            ->getRepository(Items::class)
            ->findOneById($id);

        $item->setName($request->get('name'));
        $item->setAmount($request->get('amount'));
        $manager->flush();

        return new Response(self::SUCCESS_UPDATED_ITEM, Response::HTTP_OK);
    }
}
