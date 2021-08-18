<?php

namespace App\Controller;

use App\Entity\GestionAssociation;
use App\Form\GestionAssociationType;
use App\Repository\GestionAssociationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gestion/association")
 */
class GestionAssociationController extends AbstractController
{
    /**
     * @Route("/", name="gestion_association_index", methods={"GET"})
     */
    public function index(GestionAssociationRepository $gestionAssociationRepository): Response
    {
        return $this->render('gestion_association/index.html.twig', [
            'gestion_associations' => $gestionAssociationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gestion_association_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gestionAssociation = new GestionAssociation();
        $form = $this->createForm(GestionAssociationType::class, $gestionAssociation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gestionAssociation);
            $entityManager->flush();

            return $this->redirectToRoute('gestion_association_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gestion_association/new.html.twig', [
            'gestion_association' => $gestionAssociation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="gestion_association_show", methods={"GET"})
     */
    public function show(GestionAssociation $gestionAssociation): Response
    {
        return $this->render('gestion_association/show.html.twig', [
            'gestion_association' => $gestionAssociation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gestion_association_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GestionAssociation $gestionAssociation): Response
    {
        $form = $this->createForm(GestionAssociationType::class, $gestionAssociation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gestion_association_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gestion_association/edit.html.twig', [
            'gestion_association' => $gestionAssociation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="gestion_association_delete", methods={"POST"})
     */
    public function delete(Request $request, GestionAssociation $gestionAssociation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gestionAssociation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gestionAssociation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gestion_association_index', [], Response::HTTP_SEE_OTHER);
    }
}
