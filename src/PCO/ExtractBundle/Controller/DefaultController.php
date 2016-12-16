<?php

namespace PCO\ExtractBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PCOExtractBundle:Default:index.html.twig');
    }
}
