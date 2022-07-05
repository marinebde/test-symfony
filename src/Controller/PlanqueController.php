<?php

namespace App\Controller;

use App\Entity\Planque;
use App\Form\PlanqueType;
use App\Repository\PlanqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/planque")
 */
class PlanqueController extends AbstractController
{
    /**
     * @Route("/", name="app_planque_index", methods={"GET"})
     */
    public function index(PlanqueRepository $planqueRepository): Response
    {
        return $this->render('planque/index.html.twig', [
            'planques' => $planqueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_planque_new", methods={"GET", "POST"})
     * @isGranted("ROLE_USER")
     */
    public function new(Request $request, PlanqueRepository $planqueRepository): Response
    {
        $planque = new Planque();
        $form = $this->createForm(PlanqueType::class, $planque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planqueRepository->add($planque);
            return $this->redirectToRoute('app_planque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planque/new.html.twig', [
            'planque' => $planque,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_planque_show", methods={"GET"})
     */
    public function show(Planque $planque): Response
    {
        return $this->render('planque/show.html.twig', [
            'planque' => $planque,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_planque_edit", methods={"GET", "POST"})
     * @isGranted("ROLE_USER")
     */
    public function edit(Request $request, Planque $planque, PlanqueRepository $planqueRepository): Response
    {
        $form = $this->createForm(PlanqueType::class, $planque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planqueRepository->add($planque);
            return $this->redirectToRoute('app_planque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planque/edit.html.twig', [
            'planque' => $planque,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_planque_delete", methods={"POST"})
     * @isGranted("ROLE_USER")
     */
    public function delete(Request $request, Planque $planque, PlanqueRepository $planqueRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planque->getId(), $request->request->get('_token'))) {
            $planqueRepository->remove($planque);
        }

        return $this->redirectToRoute('app_planque_index', [], Response::HTTP_SEE_OTHER);
    }
}
