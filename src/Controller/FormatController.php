<?php

namespace App\Controller;

use App\Entity\Format;
use App\Service\ApiTmdbService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/format", name="format_")
 */
class FormatController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('format/index.html.twig', [
            'controller_name' => 'FormatController',
        ]);
    }

    /**
     * @Route("/add", name="format")
     */
    public function addFormat(ApiTmdbService $apiTmdb, ManagerRegistry $doctrine): Response
    {

        $entityManager = $doctrine->getManager();

        //Add the new film to BDD
        $format =new Format();
        $format->setSort('BluRay');

        //Save the Movie
        $entityManager->persist($format);
        //Insert the movie
        $entityManager->flush();
        // If succeed this message appears
        return new Response('Nouveau format ajouté'.$format->getId());
      
    }
}
