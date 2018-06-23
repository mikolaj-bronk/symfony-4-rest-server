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
     * @FOSRest\Get("/items")
     */
    public function getAll()
    {
        $items = $this->repository->findAll();

        return new JsonResponse($items, Response::HTTP_OK);
    }

    /**
     * Get one item [GET]
     * @FOSRest\Get("/items/{id}")
     */
    public function getOne(int $id)
    {
        $item = $this->repository->findOneById($id);

        return new JsonResponse($item, Response::HTTP_OK);
    }

    /**
     * Returns items where amount is equal to zero [GET]
     * @FOSRest\Get("/unavailable")
     */
    public function getUnavailable()
    {
        $items = $this->repository->findItemsWhere('=');

        return new JsonResponse($items, Response::HTTP_OK);
    }

    /**
     * Display items where amount is greater than zero [GET]
     * @FOSRest\Get("/available")
     */
    public function getAvailable()
    {
        $items = $this->repository->findItemsWhere('>', 0);

        return new JsonResponse($items, Response::HTTP_OK);
    }

    /**
     * Display items where amount is greater than {amount} [GET]
     * @FOSRest\Get("/available/{amount}")
     */
    public function getGreaterThan($amount)
    {
        $items = $this->repository->findItemsWhere('>', $amount);

        return new JsonResponse($items, Response::HTTP_OK);
    }

    /**
     * Create item [POST]
     * @FOSRest\Post("/items")
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
     * @FOSRest\Delete("/items/{id}")
     */
    public function delete($id)
    {
        $item = $this->getDoctrine()
            ->getRepository(Items::class)
            ->findOneById($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($item);
        $manager->flush();

        return new Response(self::SUCCESS_DELETED_ITEM, Response::HTTP_OK);
    }

    /**
     * Update item [PUT]
     * @FOSRest\Put("/items")
     */
    public function update(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $item = $this->getDoctrine()
            ->getRepository(Items::class)
            ->findOneById($request->get('id'));

        $item->setName($request->get('name'));
        $item->setAmount($request->get('amount'));
        $manager->flush();

        return new Response(self::SUCCESS_UPDATED_ITEM, Response::HTTP_OK);
    }
}
