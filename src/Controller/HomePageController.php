<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    const defaultArray = array("Code" => "Finish up this todo app");

    #[Route('/', name: 'homePage')]
    public function index(SessionInterface $session): Response
    {
        $session->start();
        if($session->get("todoArr") === null){ // Strict comparison to allow an empty list
            $session->set("todoArr", self::defaultArray);
        }
        
        return $this->render('home_page/index.html.twig', [
            'todoList' => $session->get("todoArr"),
        ]);
    }
}
