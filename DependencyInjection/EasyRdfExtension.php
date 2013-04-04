<?php

namespace Conjecto\EasyRdfBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class EasyRdfExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration($container->getParameter('kernel.debug'));
        $config = $this->processConfiguration($configuration, $configs);

        // load des services
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        // namespaces
        $this->loadNamespaces($config, $container);

        // type mapper
        $this->loadTypeMaps($config, $container);

        // sparql endpoints
        $this->loadSparqlClients($config, $container);
    }

    /**
     * Register all declared namespaces
     */
    public function loadNamespaces(array $config, ContainerBuilder $container)
    {
        if (empty($config['namespaces'])) return;
        foreach ($config['namespaces'] as $prefix => $namespace) {
            $container->getDefinition('easyrdf.namespace')
                ->addMethodCall('set', array($prefix, $namespace['uri']));
        }
    }

    /**
     * Declare all type maps
     */
    public function loadTypeMaps(array $config, ContainerBuilder $container)
    {
        if(empty($config['type_maps'])) return;
        foreach($config['type_maps'] as $type => $map) {
            $container->getDefinition('easyrdf.type_mapper')
                ->addMethodCall('set', array($type, $map['class']));
        }
    }

    /**
     * Prepare SPARQL clients
     */
    public function loadSparqlClients(array $config, ContainerBuilder $container)
    {
        if(empty($config['endpoints'])) return;
        foreach($config['endpoints'] as $name => $endpoint) {
            $container
              ->setDefinition('easyrdf.sparql.connection.'.$name, new DefinitionDecorator('easyrdf.sparql.connection'))
              ->setArguments(array($endpoint['uri']));
            $container->setAlias('sparql.'.$name, 'easyrdf.sparql.connection.'.$name);
            if($name == $config["default_endpoint"])
                $container->setAlias('sparql', 'easyrdf.sparql.connection.'.$name);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/';
    }

    /**
     * {@inheritDoc}
     */
    public function getNamespace()
    {
        return 'http://www.conjecto.com/schema/dic/easyrdf';
    }
}
