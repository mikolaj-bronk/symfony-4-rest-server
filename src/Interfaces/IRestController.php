<?php
namespace App\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface IRestController
{
    /**
     * Returns all items [GET]
     * @method GET
     * @Route("/items", name="items_return")
     */
    public function getAll();

    /**
     * Create item [POST]
     * @method POST
     * @Route("/items", name="items_add")
     */
    public function createItem(Request $request);

    /**
     * Delete item [DELETE]
     * @Route("/delete", name="items_delete")
     * @FOSRest\Delete("/delete")
     */
    public function delete(Request $request);
}
