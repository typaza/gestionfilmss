<?php

namespace FilmoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function accueilAction()
    {
        return $this->render('FilmoBundle::index.html.twig');
    }
}
