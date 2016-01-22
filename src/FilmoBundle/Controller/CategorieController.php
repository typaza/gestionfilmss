<?php

namespace FilmoBundle\Controller;

use FilmoBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategorieController extends Controller
{
    public function ajoutAction()
    {

        $em = $this->getDoctrine()->getManager();
        $categorie = new Categorie();
        $categorie->setNom('achraf');
        $em->persist($categorie);
        $em->flush();
        return $this->render('FilmoBundle:Categorie:ajout.html.twig');
    }
    public function showAction()
    {
        $cat = $this->getDoctrine()->getRepository('FilmoBundle:Categorie')->findAll();

        return $this->render('FilmoBundle:Categorie:show.html.twig',array('categ' => $cat));
    }
}
