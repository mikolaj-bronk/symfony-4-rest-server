<?php
namespace App\Controller\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface RestInterface
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
    public function create(Request $request);

    /**
     * Delete item [DELETE]
     * @Route("/delete", name="items_delete")
     * @FOSRest\Delete("/delete")
     */
    public function delete(Request $request);

}
