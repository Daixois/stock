<?php

namespace App\Controller;

use App\Entity\Format;
use App\Entity\Movie;
use App\Form\AddFormatType;
use App\Form\AddMovieType;
use ContainerFsOEuO1\getForm_RegistryService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    /**
     *  @Route("/insert", name="insert")
     */

    public function insert(Request $request, ManagerRegistry $doctrine)
    {
        $movie= new Movie;
        $formMovie= $this->createForm(AddMovieType::class, $movie);

        $formMovie->add('creer', SubmitType::class,
                    array('label'=>'Ajout d\'un film' ));

        $formMovie->handleRequest($request);
                
        if ($request->isMethod('post') && $formMovie->isValid()) {
            // New getDoctrine->getManager
            //$em=$this->getDoctrine()->getManager
            
            //$em = $this->doctrine;
            $em = $doctrine->getManager();

            //return new JsonResponse($request->request->all());

            //return $this->redirect($this->generateUrl('insert'));

            $em->persist($movie);
            $em->flush();

            return $this->redirect($this->generateUrl('movie_movie'));
        }
        $format= new Format;
        $formFormat= $this->createForm(AddFormatType::class, $format);

        $formFormat->add('creer', SubmitType::class,
                    array('label'=>'Ajout d\'un format' ));

        $formFormat->handleRequest($request);
                
        if ($request->isMethod('post') && $formFormat->isValid()) {
            // New getDoctrine->getManager
            //$em=$this->getDoctrine()->getManager
            
            //$em = $this->doctrine;
            $em = $doctrine->getManager();

            //return new JsonResponse($request->request->all());

            //return $this->redirect($this->generateUrl('insert'));

            $em->persist($format);
            $em->flush();

            return $this->redirect($this->generateUrl('format_format'));
        }
        return $this->render('admin/add.html.twig',
                        array('my_form'=>$formMovie->createView()));
    }

      /**
     *  @Route("/update/{id}", name="update")
     */

    public function update(Request $request,$id): Response
    {
        return $this->render('admin/create.html.twig');
    }

      /**
     *  @Route("/delete/{id}", name="delete")
     */

    public function delete(Request $request, $id)
    {
    }

    /**
     *  @Route("/add/format", name="add_format")
     */

    // public function addFormat(Request $request, ManagerRegistry $doctrine)
    // {
    //     $format= new Format;
    //     $formFormat= $this->createForm(AddFormatType::class, $format);

    //     $formFormat->add('creer', SubmitType::class,
    //                 array('label'=>'Ajout d\'un format' ));

    //     $formFormat->handleRequest($request);
                
    //     if ($request->isMethod('post') && $formFormat->isValid()) {
    //         // New getDoctrine->getManager
    //         //$em=$this->getDoctrine()->getManager
            
    //         //$em = $this->doctrine;
    //         $em = $doctrine->getManager();

    //         //return new JsonResponse($request->request->all());

    //         //return $this->redirect($this->generateUrl('insert'));

    //         $em->persist($format);
    //         $em->flush();

    //         return $this->redirect($this->generateUrl('format_format'));
    //     }
    //     return $this->render('admin/add.html.twig',
    //                     array('my_form'=>$formFormat->createView()));
    // }
}
