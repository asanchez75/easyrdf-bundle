<?php
/**
 * Auteur: Blaise de Carné - blaise@concretis.com
 */


namespace Conjecto\Bundle\EasyRdfBundle\Serializer;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;

class Serializer implements SerializerInterface {

    /**
     * {@inheritdoc}
     */
    public function serialize($data, $format, SerializationContext $context = null) {
        return $data->serialise($format);
    }

    /**
     * {@inheritdoc}
     */
    public function deserialize($data, $type, $format, DeserializationContext $context = null) {
        $graph = new \EasyRdf_Graph();
        $graph->parse($data, $format);
    }
}
