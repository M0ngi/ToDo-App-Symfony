<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AddTodoController extends AbstractController
{
    #[Route('/todo/add', name: 'app_add_todo', methods:'POST')]
    public function index(Request $req, SessionInterface $session): Response
    {
        $session->start();
        $todoName = $req->request->get('newTodoName');
        $todoValue = $req->request->get('newTodoValue');
        $oldToDo =  $session->get('todoArr');
        
        if($oldToDo == null){
            $session->set('todoArr',  HomePageController::defaultArray);
            $oldToDo = HomePageController::defaultArray;
        }
        $oldToDo[$todoName] = $todoValue;
        $session->set("todoArr", $oldToDo);

        return $this->redirectToRoute('homePage');
    }
}
