<?php

namespace App\Controller;

use App\Entity\Rdv;
use App\Form\RdvSearchType;
use App\Form\RdvType;
use App\Repository\RdvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RdvController extends AbstractController
{
    /**
     * @Route("/rdv", name="rdv")
     */
    public function index(): Response
    {
        return $this->render('rdv/index.html.twig', [
            'controller_name' => 'RdvController',
        ]);
    }

     /**
     * @Route("/rdv/add", name="rdvADD")
     */
    public function addRdv(Request $request): Response
    {
        $rdv = new Rdv();
        $form = $this->createForm(RdvType::class, $rdv);
        $form->add('envoyer', SubmitType::class, ['label' => 'Envoyer']);
        $form->add('réinitialiser', ResetType::class, ['label' => 'Réinitialiser']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rdv);
            $entityManager->flush();
            new Response('Saved new rdv with id ' . $rdv->getId());
            return $this->redirectToRoute('rdvSearch');
        }

        return $this->render('rdv/addRdv.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/rdv/list", name="rdvList")
     */
    public function listRdv(): Response
    {
        $r = $this->getDoctrine()->getRepository(Rdv::class);
        $list =  $r->findAll();
        return $this->render('rdv/list.html.twig', [
            'searchRdv' => null,
            'list' => $list
        ]);
    }

     /**
     * @Route("/rdv/search", name="rdvSearch")
     */
    public function searchRdv(Request $request,RdvRepository $repository): Response
    {
        $searchForm = $this->createForm(RdvSearchType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $voyageur = $searchForm->getData()->getVoyageur();
            $resultOfSearch = $repository->searchVoyageur($voyageur);
            return $this->render('rdv/list.html.twig', array(
                "list" => $resultOfSearch,
                "searchRdv" => $searchForm->createView()));
        }
        $rdvs = $repository->findAll();
        return $this->render('rdv/list.html.twig', [
            'list'=> $rdvs,
            "searchRdv" => $searchForm->createView()
        ]);
    }
}
