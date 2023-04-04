<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if(!$session->has('todos')){
            $todos = [
                'achat' => 'acheter clé usb',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'
            ];
            $session->set('todos',$todos);
            $this->addFlash('info',"La liste des todos viens d'étre initialisée");
        }
        return $this->render('todo/index.html.twig');
    }
    #[Route('/todo/add',name:'todo.new')]
    public function add(): Response
    {
        return $this->render('todo/add.html.twig');
    }
    #[Route('/todo/add/{name}/{content}',name:'todo.add')]
    public function addTodo(Request $request,$name,$content){
        $session = $request->getSession();
        // vérifier si j ai mon tableau de todo dans la session
        if($session->has('todos')){
            $todos = $session->get('todos');
            // Vérifier si on a déja un todo avec le méme name 
            if(isset($todos[$name])){
                // si oui afficher erreur
                $this->addFlash('error',"Le todo d'id $name existe déja dans la liste") ;
            }else{
                // Si non on l'ajouter et on affiche un message de succés
                $todos[$name] = $content;
                $session->set('todos',$todos);
                $this->addFlash('success',"Le todo d'id $name a été ajouité avec succés");
            }

        }else{
            // afficher une erreur et on va redireger vers le controlleur index
            $this->addFlash('error',"La liste des todos n'est pas encore initialisée ") ;
        }
        return $this->forward('App\Controller\TodoController::index');
    }
    #[Route('/todo/update/{name}/{content}',name:'todo.update')]
    public function updateTodo(Request $request,$name,$content) : RedirectResponse{
        $session = $request->getSession();
        // vérifier si j'ai mon tableau de todo dans la session
        if($session->has('Todos')){
            $todos = $session->get('todos');
            // verifier si la tache existe déja
            if(isset($todos[$name])){
            $todos[$name] = $content;
            $session->set('todos',$todos);
            $this->addFlash('success',"Le todo d'id $name a été mise a jour avec succés");
            }else{
                $this->addFlash('error',"le todo d'id $name n'existe pas");
            }

        }else{
            $this->addFlash('error',"La liste des todos n'est pas encore initialisée ") ;
        }
        return $this->forward('App\Controller\TodoController::index');
    }
    #[Route('todo/reset',name:'todo.reset')]
    public function resetTodo(Request $request) : RedirectResponse{
        $session = $request->getSession();
        $session->remove('todos');
        return $this->redirectToRoute('todo');
    }
    
    #[Route('multi/{op1<\d+>}/{op2<\d+>}',
    name:"multiplication",
    )]
    public function mulitiplication(Request $request,$op1,$op2)
    {
        $res = $op1 * $op2;
        return new Response("<h1>$res</h1>");
    }

}
