Provides integration for EasyRdf_ for your Symfony2 Project.

Features
========

This bundle allows to easily use EasyRdf_ in your Symfony2
project.

Installation
============

Add configuration
----------------------------------

::

    # app/config/config.yml
    easyrdf:
        namespaces:
            rdf:    "http://www.w3.org/1999/02/22-rdf-syntax-ns#"
            rdfs:   "http://www.w3.org/2000/01/rdf-schema#"
            ogbd:   "http://www.ogbd.fr/2012/ontologie#"
            rel:    "http://purl.org/vocab/relationship/"
            bio:    "http://purl.org/vocab/bio/0.1/"
            dc:     "http://purl.org/dc/elements/1.1/"
            dcterm: "http://purl.org/dc/terms/"
            ical:   "http://www.w3.org/2002/12/cal/ical#"
            foaf:   "http://xmlns.com/foaf/0.1/"
            time:   "http://www.w3.org/2006/time#"
        endpoints:
            sesame: http://dev.conjecto/openrdf-sesame/repositories/memory-rdfs-dth
            virtuoso: http://dev.conjecto:8890/sparql
        default_endpoint: sesame
