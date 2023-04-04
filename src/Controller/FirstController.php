<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first/{name}', name: 'app_first')]
    public function index(HttpFoundationRequest $req,$name): Response
    {
        dd($req);
        return $this->render('first/index.html.twig', [
            'controller_name' => $name,
        ]);
    }
}
