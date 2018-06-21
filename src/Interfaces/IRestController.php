<?php
namespace App\Interfaces;
use Symfony\Component\HttpFoundation\Request;

interface IRestController
{
    /**
     * Display all items [GET]
     * @method GET
     * @Route("/items", name="items_display")
     */
    public function getAll();
}