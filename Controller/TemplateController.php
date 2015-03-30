<?php

namespace Tecnocreaciones\Crm\TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TemplateController extends Controller
{
    public function indexAction()
    {
//        var_dump(\Pandco\Bundle\AppBundle\Service\Tools::phoneAsterisks("04128493833"));
//        var_dump(\Pandco\Bundle\AppBundle\Service\Tools::bankAccountAsterisks("01234567890123456789"));
//        var_dump(\Pandco\Bundle\AppBundle\Service\Tools::cardAsterisks("0123456789123456"));
//        var_dump(\Pandco\Bundle\AppBundle\Service\Tools::cardAsterisks("0123456789123456",2));
//        die;
        return $this->render('TecnocreacionesCrmTemplateBundle:Template:index.html.twig', array());
    }
}
