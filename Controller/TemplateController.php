<?php

namespace Tecnocreaciones\Crm\TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TemplateController extends Controller
{
    public function indexAction()
    {
        return $this->render('TecnocreacionesCrmTemplateBundle:Template:index.html.twig', array());
    }
}
