<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrandNewController extends AbstractController
{
    /**
     * @Route("/", name="Accueil")
     */
    public function index(): Response
    {
        return $this->render('brand_new/accueil.html.twig', [
            'controller_name' => 'Accueil',
        ]);
    }
    /**
     * @Route("/contact", name="Contact")
     */
    public function contact(): Response
    {
        return $this->render('brand_new/contact.html.twig', [
            'controller_name' => 'Contact',
        ]);
    }
    /**
     * @Route("/mentionsL", name="MentionsL")
     */
    public function MentionsL(): Response
    {
        return $this->render('brand_new/mentionsL.html.twig', [
            'controller_name' => 'MentionsL',
        ]);
    }
}
