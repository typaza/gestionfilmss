<?php

namespace FilmoBundle\Controller;

use FilmoBundle\Entity\Acteur;
use FilmoBundle\Form\ActeurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActeurController extends Controller
{
    public function ajoutAction()
    {
        $message="Formulaire d'ajout d'acteur";
        $em=$this->getDoctrine()->getManager();
        $act = new Acteur();
        $form=$this->createForm(new ActeurType(),$act);
        $request = new Request(
            $_GET,
            $_POST,
            array(),
            $_COOKIE,
            $_FILES,
            $_SERVER
        );
        if($request->getMethod()=='POST'){
            $form->handleRequest($request);
            if($form->isValid()){
                $em->persist($act);
                $em->flush();
                $message="Acteur ajouté avec succés";
            }

        }


        return $this->render('FilmoBundle:Acteur:ajout.html.twig',array(
            'form'=>$form->createView(),
            'msg'=>$message
        ));
    }
    public function showAction()
    {
        return $this->render('FilmoBundle:Acteur:show.html.twig');
    }
}
