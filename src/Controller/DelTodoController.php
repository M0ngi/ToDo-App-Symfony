<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DelTodoController extends AbstractController
{
    #[Route('/remove/{todo_id}', name: 'app_del_todo')]
    public function index(SessionInterface $session, string $todo_id): Response
    {
        $session->start();
        $oldToDo =  $session->get('todoArr');
        $todo_id = base64_decode($todo_id, true); // Strict

        if(!$todo_id){
            $this->addFlash(
                'notificationMsgErr',
                'Invalid todo! Quit messing around!'
            );
     
            return $this->redirectToRoute('homePage');
        }

        if($oldToDo == null){
            $this->addFlash(
                'notificationMsgErr',
                'You don\'t have any todos!'
            );
     
            return $this->redirectToRoute('homePage');
        }

        if(!array_key_exists($todo_id, $oldToDo)){
            $this->addFlash(
                'notificationMsgErr',
                'Todo not found!'
            );
     
            return $this->redirectToRoute('homePage');
        }

        unset($oldToDo[$todo_id]);
        $session->set('todoArr', $oldToDo);
        $this->addFlash(
            'notificationMsg',
            'Todo deleted successfully!'
        );
 
        return $this->redirectToRoute('homePage');
    }
}
