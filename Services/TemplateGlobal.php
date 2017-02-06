<?php

/*
 * This file is part of the Witty Growth C.A. - J406095737 package.
 * 
 * (c) www.mpandco.com
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tecnocreaciones\Crm\TemplateBundle\Services;

/**
 * Configuraciones globales (template.global)
 *
 * @author Carlos Mendoza <inhack20@gmail.com>
 */
class TemplateGlobal {
    private $extraValues = [];
    
    public function addExtraValue($key, $value) {
        $this->extraValues[$key] = $value;
        return $this;
    }
    
    public function getExtraValues() {
        return $this->extraValues;
    }
}
