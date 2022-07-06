<?php

namespace App\Controller;

use App\Entity\Cible;
use App\Form\CibleType;
use App\Repository\CibleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/cible")
 */
class CibleController extends AbstractController
{
    /**
     * @Route("/", name="app_cible_index", methods={"GET"})
     */
    public function index(CibleRepository $cibleRepository): Response
    {
        return $this->render('cible/index.html.twig', [
            'cibles' => $cibleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_cible_new", methods={"GET", "POST"})
     * @isGranted("ROLE_USER")
     */
    public function new(Request $request, CibleRepository $cibleRepository): Response
    {
        $cible = new Cible();
        $form = $this->createForm(CibleType::class, $cible);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cibleRepository->add($cible);
            return $this->redirectToRoute('app_cible_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cible/new.html.twig', [
            'cible' => $cible,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_cible_show", methods={"GET"})
     */
    public function show(Cible $cible): Response
    {
        return $this->render('cible/show.html.twig', [
            'cible' => $cible,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_cible_edit", methods={"GET", "POST"})
     * @isGranted("ROLE_USER")
     */
    public function edit(Request $request, Cible $cible, CibleRepository $cibleRepository): Response
    {
        $form = $this->createForm(CibleType::class, $cible);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cibleRepository->add($cible);
            return $this->redirectToRoute('app_cible_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cible/edit.html.twig', [
            'cible' => $cible,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_cible_delete", methods={"POST"})
     * @isGranted("ROLE_USER")
     */
    public function delete(Request $request, Cible $cible, CibleRepository $cibleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cible->getId(), $request->request->get('_token'))) {
            $cibleRepository->remove($cible);
        }

        return $this->redirectToRoute('app_cible_index', [], Response::HTTP_SEE_OTHER);
    }
}
