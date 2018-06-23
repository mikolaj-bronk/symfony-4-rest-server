<?php
namespace App\Controller\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface RestInterface
{
    /**
     * Get one item [GET]
     * @FOSRest\Get("/items/{id}")
     */
    public function getOne(int $id);

    /**
     * Returns all items [GET]
     * @FOSRest\Get("/items")
     */
    public function getAll();

    /**
     * Create item [POST]
     * @FOSRest\Post("/items")
     */
    public function create(Request $request);

    /**
     * Delete item [DELETE]
     * @FOSRest\Delete("/items/{id}")
     */
    public function delete(int $id);

    /**
     * Update item [PUT]
     * @FOSRest\Put("/items")
     */
    public function update(Request $request);
}
