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

use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\Request;
use Tecnocreaciones\Crm\TemplateBundle\Menu\MenuBuilder;

/**
 * Main menu builder.
 *
 * @author Anais Ortega <adcom23@tecnocreaciones.com.ve>
 */
class Menu extends MenuBuilder
{
    /**
     * Base de segundo nivel de sidebar
     * @var array 
     */
    private $secondLevelOptions = array('childrenAttributes' => array('class' => 'submenu'));
    
    const ROUTE_DEFAULT = 'tecnocreaciones_crm_template_homepage';
    const ROUTE_CUSTOMER = 'customer';
    const ROUTE_CUSTOMER_CREATE = 'customer_new';
    const ROUTE_ITEM = 'item';
    const ROUTE_ITEM_CREATE = 'item_new';


    /**
     * Builds backend sidebar menu.
     *
     * @param Request $request
     *
     * @return ItemInterface
     */
    public function createSidebarMenu(Request $request)
    {
        $menu = $this->factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav sidebar-menu',
            )
        ));
        $section = 'sidebar';
        $menu->addChild('home',array(
            'route' => self::ROUTE_DEFAULT,
            'routeParameters' => $this->generateRouteTemporal(),
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-home'),
        ))->setLabel($this->translate(sprintf('app.%s.dashboard', $section)));
        $menu->addChild('data_boxes',array(
            'route' => 'tecnocreaciones_crm_template_homepage_tmp_1',
            'routeParameters' => $this->generateRouteTemporal(),
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-tasks'),
        ))->setLabel($this->translate(sprintf('app.%s.data_boxes', $section)));
        
        $menu->addChild('widgets',array(
            'route' => self::ROUTE_DEFAULT,
            'routeParameters' => $this->generateRouteTemporal(),
            'labelAttributes' => array('icon' => 'fa fa-th'),
        ))->setLabel($this->translate(sprintf('app.%s.widgets', $section)));
        
//        $this->addExampleMenu($menu, $section);
        $this->addClientMenu($menu, $section);
        $this->addProductAndServices($menu, $section);
        
        return $menu;
    }
    
    function addClientMenu(ItemInterface $menu, $section) {
        $child = $this->factory->createItem('more_pages',
                    $this->getSubLevelOptions(array(
                    'uri' => null,
                    'labelAttributes' => array('icon' => 'glyphicon glyphicon-user'),
                    ))
                )
                ->setLabel($this->translate(sprintf('Cliente', $section)));
        $child
                ->addChild(null, array(
                    'route' => self::ROUTE_CUSTOMER,
                    'labelAttributes' => array('icon' => 'glyphicon glyphicon-th-list'),
                    'routeParameters' => $this->generateRouteTemporal(),
                    ))
                ->setLabel($this->translate(sprintf('ManageClient', $section)));
        $child
                ->addChild('more_pages.error_500', array(
                    'route' => self::ROUTE_CUSTOMER_CREATE,
                    'labelAttributes' => array('icon' => 'glyphicon glyphicon-plus-sign'),
                    'routeParameters' => $this->generateRouteTemporal(),
                    ))
                ->setLabel($this->translate(sprintf('CreateClient', $section)));
        
        $menu->addChild($child);
    }
    
    public function addProductAndServices(ItemInterface $menu, $section) {
        $subchild = $this->factory->createItem('multi_level_menu',
                        $this->getSubLevelOptions(array(
                        'uri' => null,
                            'labelAttributes' => array('icon' => 'glyphicon glyphicon-briefcase'),
                        ))
                    )
                    ->setLabel($this->translate(sprintf('ProductsAndServices', $section)));

        $subchildLevel4 = $this->factory->createItem('multi_level_menu.level_4',$this->getSubLevelOptions(array(
                    'uri' => null,
                        'labelAttributes' => array('icon' => 'glyphicon glyphicon-shopping-cart'),
                    )))
                    ->setLabel($this->translate(sprintf('Productos', $section)));
            
        $subchildLevel4->addChild('multi_level_menu.level_4_some_item', array(
                        'route' => 'item',
                        'routeParameters' => $this->generateRouteTemporal(),
                        'labelAttributes' => array('icon' => 'glyphicon glyphicon-th-list'),
                        ))
                      ->setLabel('Gestionar');
                     
        $subchildLevel4->addChild('multi_level_menu.level_5_some_item', array(
                        'route' => self::ROUTE_ITEM_CREATE,
                        'routeParameters' => $this->generateRouteTemporal(),
                        'labelAttributes' => array('icon' => 'glyphicon glyphicon-plus-sign'),
                        ))
                      ->setLabel($this->translate('CreateProduct'));
                     
        $subchild->addChild($subchildLevel4);
        
        $menu->addChild($subchild);
        
    }


    /**
     * Construye el menu de ejemplo
     * 
     * @param \Knp\Menu\ItemInterface $menu
     * @param type $section
     */
    function addExampleMenu(ItemInterface $menu, $section) {
        $child = $this->factory->createItem('more_pages',
                    $this->getSubLevelOptions(array(
                    'uri' => null,
                    'labelAttributes' => array('icon' => 'glyphicon glyphicon-link'),
                    ))
                )
                ->setLabel($this->translate(sprintf('app.%s.more_pages.more_pages', $section)));
        $child
                ->addChild('more_pages.error_404', array(
                    'route' => self::ROUTE_DEFAULT,
                    'routeParameters' => $this->generateRouteTemporal(),
                    ))
                ->setLabel($this->translate(sprintf('app.%s.more_pages.error_404', $section)));
        $child
                ->addChild('more_pages.error_500', array(
                    'route' => self::ROUTE_DEFAULT,
                    'routeParameters' => $this->generateRouteTemporal(),
                    ))
                ->setLabel($this->translate(sprintf('app.%s.more_pages.error_500', $section)));
        
        
            $subchild = $this->factory->createItem('multi_level_menu',
                        $this->getSubLevelOptions(array(
                        'uri' => null,
                        ))
                    )
                    ->setLabel($this->translate(sprintf('app.%s.more_pages.multi_level_menu.multi_level_menu', $section)));
            $subchild
                    ->addChild('multi_level_menu.level_3', array(
                        'route' => self::ROUTE_DEFAULT,
                        'routeParameters' => $this->generateRouteTemporal(),
                        'labelAttributes' => array('icon' => 'fa fa-camera'),
                        ))
                    ->setLabel($this->translate(sprintf('app.%s.more_pages.multi_level_menu.level_3', $section)));
            
            $subchildLevel4 = $this->factory->createItem('multi_level_menu.level_4',$this->getSubLevelOptions(array(
                    'uri' => null,
                        'labelAttributes' => array('icon' => 'fa fa-asterisk'),
                    )))
                    ->setLabel($this->translate(sprintf('app.%s.more_pages.multi_level_menu.level_4', $section)));
            
                     $subchildLevel4->addChild('multi_level_menu.level_4_some_item', array(
                        'route' => 'tecnocreaciones_crm_template_homepage_tmp_3',
                        'routeParameters' => $this->generateRouteTemporal(),
                        'labelAttributes' => array('icon' => 'fa fa-bolt'),
                        ))
                      ->setLabel($this->translate(sprintf('app.%s.more_pages.multi_level_menu.some_item', $section)));
                     
            $subchild->addChild($subchildLevel4);
        
            $child->addChild($subchild);
               
        $menu->addChild($child);
    }
    
    protected function getSubLevelOptions(array $parameters = array()) {
        return array_merge($this->secondLevelOptions,$parameters);
    }
    
    protected function getSecondLevelOptions(array $parameters = array()) {
        return array_merge($this->secondLevelOptions,$parameters);
    }
    
    private function generateRouteTemporal()
    {
        static $i = 0;
        return array();
    }
}
