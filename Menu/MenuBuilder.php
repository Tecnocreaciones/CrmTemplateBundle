<?php

/*
 * This file is part of the TecnoCreaciones package.
 * 
 * (c) www.tecnocreaciones.com.ve
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tecnocreaciones\Crm\TemplateBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Tecnocreaciones\Crm\TemplateBundle\Services\TemplateGlobal;

/**
 * Abstract menu builder.
 *
 * @author Anais Ortega <adcom23@tecnocreaciones.com.ve>
 */
abstract class MenuBuilder
{
    /**
     * Menu factory.
     *
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * Security context.
     *
     * @var SecurityContextInterface
     */
    protected $securityContext;

    /**
     * Translator instance.
     *
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * Request.
     *
     * @var Request
     */
    protected $request;
    
    /**
     * @var TemplateGlobal
     */
    protected $templateGlobal;
    
    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * Constructor.
     *
     * @param FactoryInterface         $factory
     * @param $securityContext
     * @param TranslatorInterface      $translator
     */
    public function __construct(FactoryInterface $factory, $securityContext, TranslatorInterface $translator, RouterInterface $router,TemplateGlobal $templateGlobal)
    {
        $this->factory = $factory;
        $this->securityContext = $securityContext;
        $this->translator = $translator;
        $this->router = $router;
        $this->templateGlobal = $templateGlobal;
    }

    /**
     * Sets the request the service
     *
     * @param Request $request
     */
    public function setRequest(RequestStack $request = null)
    {
        $this->request = $request->getCurrentRequest();
    }

    /**
     * Translate label.
     *
     * @param string $label
     * @param array  $parameters
     *
     * @return string
     */
    protected function translate($label, $parameters = array())
    {
        return $this->translator->trans(/** @Ignore */ $label, $parameters, 'menu');
    }    
    
    /**
     * Evaluar permisos por rol
     * 
     * @param type $attributes
     * @param type $object
     * @return type
     */
    protected function isGranted($attributes,$object = null)
    {
        return $this->securityContext->isGranted($attributes, $object);
        }

    public function generateUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->router->generate($route, $parameters, $referenceType);
    }
}
