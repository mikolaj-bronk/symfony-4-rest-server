<?php
namespace App\Controller\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface RestInterface
{
    /**
     * Returns all items [GET]
     * @method GET
     * @Route("/items", name="items_all")
     */
    public function getAll();

    /**
     * Create item [POST]
     * @method POST
     * @Route("/items", name="items_create")
     */
    public function create(Request $request);

    /**
     * Delete item [DELETE]
     * @Route("/delete", name="items_delete")
     * @FOSRest\Delete("/delete")
     */
    public function delete(Request $request);

    /**
     * Update item [PUT]
     * @Route("/update/{id}", name="items_update")
     * @FOSRest\Put("/update")
     */
    public function update(int $id, Request $request);

    /**
     * Get one item [GET]
     * @Route("/items/{id}", name="items_one")
     * @FOSRest\Get("/items")
     */
    public function getOne(int $id);
}
