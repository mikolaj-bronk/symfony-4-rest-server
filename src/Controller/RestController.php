<?php

namespace App\Controller;

use App\Interfaces\IRestController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Interfaces\RestControllerInterface;

class RestController extends Controller implements IRestController
{
    /**
     * @Route("/items", name="items_display")
     */
    public function itemsGetAll()
    {
        return $this->render('rest/index.html.twig', [
            'controller_name' => 'RestController',
        ]);
    }
}
