<?php

namespace App\Controller;

use App\Entity\Voyageur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoyageurController extends AbstractController
{
    /**
     * @Route("/voyageur", name="voyageur")
     */
    public function index(): Response
    {
        return $this->render('voyageur/index.html.twig', [
            'controller_name' => 'VoyageurController',
        ]);
    }

    /**
     * @Route("/voyageur/list", name="voyageurList")
     */
    public function listVoyageur(): Response
    {
        $r = $this->getDoctrine()->getRepository(Voyageur::class);
        $list =  $r->findAll();
        return $this->render('voyageur/list.html.twig', [
            'list' => $list
        ]);
    }

    /**
     *  @param $id
     * @Route("/voyageur/{id}", name="voyageurDelete")
     */
    public function DeleteVoyageur($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Voyageur::class);
        $entityManager = $this->getDoctrine()->getManager();
        $voyageur = $repository->find($id);
        $entityManager->remove($voyageur);
        $entityManager->flush();
        return $this->redirectToRoute('voyageurList');
    }
}
