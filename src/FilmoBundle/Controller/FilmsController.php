<?php

namespace FilmoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FilmoBundle\Entity\Films;
use FilmoBundle\Form\FilmsType;

/**
 * Films controller.
 *
 */
class FilmsController extends Controller
{
    /**
     * Lists all Films entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $listefilms = $em->getRepository('FilmoBundle:Films')->findAll();

        $films  = $this->get('knp_paginator')->paginate(
            $listefilms,
            $request->query->get('page', 1)/*page number*/,
            2/*limit per page*/
        );

        return $this->render('films/index.html.twig', array(
            'pagination' => $films,
        ));
    }

    /**
     * Creates a new Films entity.
     *
     */
    public function newAction(Request $request)
    {
        $film = new Films();
        $form = $this->createForm('FilmoBundle\Form\FilmsType', $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $film->upload();
            $em->persist($film);
            $em->flush();

            return $this->redirectToRoute('films_show', array('id' => $film->getId()));
        }

        return $this->render('films/new.html.twig', array(
            'film' => $film,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Films entity.
     *
     */
    public function showAction(Films $film)
    {
        $deleteForm = $this->createDeleteForm($film);

        return $this->render('films/show.html.twig', array(
            'film' => $film,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Films entity.
     *
     */
    public function editAction(Request $request, Films $film)
    {
        $deleteForm = $this->createDeleteForm($film);
        $editForm = $this->createForm('FilmoBundle\Form\FilmsType', $film);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();

            return $this->redirectToRoute('films_edit', array('id' => $film->getId()));
        }

        return $this->render('films/edit.html.twig', array(
            'film' => $film,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Films entity.
     *
     */
    public function deleteAction(Request $request, Films $film)
    {
        $form = $this->createDeleteForm($film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($film);
            $em->flush();
        }

        return $this->redirectToRoute('films_index');
    }

    /**
     * Creates a form to delete a Films entity.
     *
     * @param Films $film The Films entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Films $film)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('films_delete', array('id' => $film->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
