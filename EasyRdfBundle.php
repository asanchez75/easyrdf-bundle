<?php

namespace Conjecto\EasyRdfBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Conjecto\EasyrdfBundle\DependencyInjection\Compiler\RegisterNamespacesPass;

class EasyRdfBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}
