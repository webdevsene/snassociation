<?php

namespace App\Controller;

use App\Form\SearchAssocFormType;
use App\Entity\GestionAssociation;
use App\Form\GestionAssociationType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GestionAssociationRepository;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/gestion/association")
 */
class GestionAssociationController extends AbstractController
{
    /**
     * @Route("/", name="gestion_association_index", methods={"POST", "GET"})
     */
    public function index(GestionAssociationRepository $gestionAssociationRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $donnees = $gestionAssociationRepository->findBy([], ['id' => 'DESC']);

        // $gestion_association = $gestionAssociationRepository->findAll();

        // creer le formulaire de recherche full text
        $form = $this->createForm(SearchAssocFormType::class);

        $search = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $donnees = $gestionAssociationRepository->search(
                $search->get('mots')->getData(),
                $search->get('types')->getData());
        }

        // mettre en place la pagination
        $gestion_association = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('gestion_association/index.html.twig', [
            'gestion_associations' => $gestion_association,
            'form' => $form->createview(),
            'count_all_assoc' => $gestionAssociationRepository->countAllAssoc()
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

    /**
     * Method pour telecharger un fichier
     * @Route("/download", name="download_file")
     */
    public function downloadFileAction()
    {
        $response = new BinaryFileResponse('path/to/pdf.pdf');
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT,'pdf.pdf');
        return $response;
    }
}
