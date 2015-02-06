<?php

namespace WCS\XSSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WCSXSSBundle:Default:index.html.twig');
    }
}
