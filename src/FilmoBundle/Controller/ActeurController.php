<?php

namespace FilmoBundle\Controller;

use FilmoBundle\Entity\Acteur;
use FilmoBundle\Form\ActeurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActeurController extends Controller
{
    public function ajoutAction()
    {
        $mbutton = "Ajouter";
        $message = "Formulaire d'ajout d'acteur";
        $em = $this->getDoctrine()->getManager();
        $act = new Acteur();
        $form = $this->createForm(new ActeurType(), $act);
        $request = new Request(
            $_GET,
            $_POST,
            array(),
            $_COOKIE,
            $_FILES,
            $_SERVER
        );
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($act);
                $em->flush();
                //$message = "Acteur ajouté avec succés";
                return $this->redirectToRoute("acteur_affiche");
            }

        }


        return $this->render('FilmoBundle:Acteur:edit.html.twig', array(
            'form' => $form->createView(),
            'msg' => $message,
            'mb' => $mbutton
        ));
    }

    public function showAction()
    {
        $cat = $this->getDoctrine()->getRepository('FilmoBundle:Acteur')->findAll();
        return $this->render('FilmoBundle:Acteur:show.html.twig', array('acteur' => $cat));
    }

    public function editAction($id)
    {
        $mbutton = "Modifer";
        $message = "modification d'acteur";
        $em = $this->getDoctrine()->getManager();
        $act = $em->getRepository("FilmoBundle:Acteur")->find($id);
        $form = $this->createForm(new ActeurType(), $act);
        $request = new Request(
            $_GET,
            $_POST,
            array(),
            $_COOKIE,
            $_FILES,
            $_SERVER
        );
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                //$message = "Acteur modifié avec succés";
                return $this->redirectToRoute("acteur_affiche");
            }

        }
        return $this->render('FilmoBundle:Acteur:edit.html.twig', array(
            'form' => $form->createView(),
            'msg' => $message,
            'mb' => $mbutton
        ));

    }

    public function delAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $act = $em->find("FilmoBundle:Acteur", $id);
        if (!$act) {
            throw $this->createNotFoundException("id not found");
        }
        $em->remove($act);
        $em->flush();
        //return new Response("Supprission effectué avec succés");
        return $this->redirectToRoute("acteur_affiche");
    }
}
