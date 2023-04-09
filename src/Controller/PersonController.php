<?php

namespace App\Controller;

use App\Entity\Person;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('personne')]
class PersonController extends AbstractController
{
    #[Route('/',name:'person.list')]
    public function index(ManagerRegistry $doctrine):Response{
        $repository = $doctrine->getRepository(Person::class);
        $personnes = $repository->findAll();
        return $this->render('person/index.html.twig',['personnes' => $personnes
    ]);
    }
    #[Route('/{id<\d+>}',name:'personne.detail')]
    public function detail(Person $person = null): Response{
        if(!$person){
            $this->addFlash('error',"La personne n'existe pas ");
            return $this->redirectToRoute('person.list');
        }
        return $this->render('person/detail.html.twig',['personne'=>$person]);
    }
    #[Route('/all/{page?1}/{nbre?12}',name: 'personne.list.all')]
    public function index_all(ManagerRegistry $doctrine,$page,$nbre):Response
    {
        $repository = $doctrine->getRepository(Person::class);
        $nbPersonne = $repository->count([]);
        $nbrePage = ceil($nbPersonne / $nbre);
        $personnes = $repository->findBy([],[],$nbre,($page-1)*$nbre);
        return $this->render('person/index.html.twig',[
            'personnes' => $personnes,
            'isPaginated' => true,
            'nbrepage' => $nbrePage,
            'page' => $page,
            'nbre' => $nbre
        ]);
    }
}
