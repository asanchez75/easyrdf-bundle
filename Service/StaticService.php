<?php
/**
 * Auteur: Blaise de Carné - blaise@concretis.com
 */

namespace Conjecto\Bundle\EasyRdfBundle\Service;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class StaticService
{
    private $class;

    public function __construct($class) {
        $this->class = $class;
    }

    public function __call($name, $arguments)
    {
        return forward_static_call_array(array($this->class, $name), $arguments);
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        // cet événement vide sert uniquement à forcer l'appel du service
    }
}
