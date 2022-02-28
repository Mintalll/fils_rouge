<?php

namespace App\Controller;

use App\Entity\Categ;
use App\Form\CategType;
use App\Repository\CategRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categ")
 */
class CategController extends AbstractController
{
    /**
     * @Route("/", name="categ_index", methods={"GET"})
     */
    public function index(CategRepository $categRepository): Response
    {
        return $this->render('categ/index.html.twig', [
            'categs' => $categRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="categ_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categ = new Categ();
        $form = $this->createForm(CategType::class, $categ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categ);
            $entityManager->flush();

            return $this->redirectToRoute('categ_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categ/new.html.twig', [
            'categ' => $categ,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="categ_show", methods={"GET"})
     */
    public function show(Categ $categ): Response
    {
        return $this->render('categ/show.html.twig', [
            'categ' => $categ,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categ_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Categ $categ, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategType::class, $categ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('categ_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categ/edit.html.twig', [
            'categ' => $categ,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="categ_delete", methods={"POST"})
     */
    public function delete(Request $request, Categ $categ, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categ->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categ);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categ_index', [], Response::HTTP_SEE_OTHER);
    }
}
