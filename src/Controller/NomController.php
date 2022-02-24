<?php

namespace App\Controller;

use App\Entity\Nom;
use App\Form\NomType;
use App\Repository\NomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nom")
 */
class NomController extends AbstractController
{
    /**
     * @Route("/", name="nom_index", methods={"GET"})
     */
    public function index(NomRepository $nomRepository): Response
    {
        return $this->render('nom/index.html.twig', [
            'noms' => $nomRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="nom_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nom = new Nom();
        $form = $this->createForm(NomType::class, $nom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($nom);
            $entityManager->flush();

            return $this->redirectToRoute('nom_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nom/new.html.twig', [
            'nom' => $nom,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="nom_show", methods={"GET"})
     */
    public function show(Nom $nom): Response
    {
        return $this->render('nom/show.html.twig', [
            'nom' => $nom,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="nom_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Nom $nom, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NomType::class, $nom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('nom_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nom/edit.html.twig', [
            'nom' => $nom,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="nom_delete", methods={"POST"})
     */
    public function delete(Request $request, Nom $nom, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nom->getId(), $request->request->get('_token'))) {
            $entityManager->remove($nom);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nom_index', [], Response::HTTP_SEE_OTHER);
    }
}
