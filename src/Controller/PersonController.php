<?php

namespace App\Controller;

use App\Entity\Person;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('personne')]
class PersonController extends AbstractController
{
    #[Route('/all/age/{ageMin}/{ageMax}',name:'person.list.age')]
    public function index(ManagerRegistry $doctrine,$ageMin,$ageMax):Response{
        $repository = $doctrine->getRepository(Person::class);
        $personnes = $repository->findPersonnesByAgeInterval($ageMin,$ageMax);
        return $this->render('person/index.html.twig',['personnes' => $personnes
    ]);
    }
    #[Route('/stats/age/{ageMin}/{ageMax}',name:'person.stat.age')]
    public function statsPersonnesByAge(ManagerRegistry $doctrine,$ageMin,$ageMax):Response{
        $repository = $doctrine->getRepository(Person::class);
        $stats = $repository->statsPersonnesByAgeInterval($ageMin,$ageMax);
        return $this->render('person/stats.html.twig',[
            'stats' => $stats[0],
            'ageMin' => $ageMin,
            'ageMax' => $ageMax
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
    #[Route('/delete/{id}',name:'personne.delete')]
    public function deletePersonne(Person $person = null,ManagerRegistry $doctrine): RedirectResponse
    {
        // Personne existe
        if($person){
            // Si la personne existe => le supprimer et retourner un flashMessage de succés
            $manager = $doctrine->getManager();
            // Ajoute la fonction de suppression dans la transaction
            $manager->remove($person);
            // Executer la Transaction
            $manager->flush();
            $this->addFlash('success','la personne a été supprimé avec succés');
        }else{
            $this->addFlash('error',"Personne innexistante");
        }
       return  $this->redirectToRoute('personne.list.all');

    }
}
