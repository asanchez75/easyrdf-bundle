It is a forked version from conjecto/easyrdf-bundle.
It implements autoload for psr-4 and add a parameter to initialize the Client service.

Usage

1) Add to your composer.json the following lines

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/asanchez75/easyrdf-bundle.git"
        }
    ],
    "require": {
        "conjecto/easyrdf-bundle": "dev-master as 0.1"
    },

2) Launch composer update inside your Symfony Application

3) Define a global parameter sparql_endpoint in your file app/config/config.yml

parameters:
    sparql_endpoint: http://localhost:8890/sparql

Be aware that the parameter %sparql_endpoint% is used in the file

https://github.com/asanchez75/easyrdf-bundle/blob/master/Resources/config/services.xml

4) Add the bundle to your file app/AppKernel.php

new Conjecto\Bundle\EasyRdfBundle\EasyRdfBundle();

5) Load your service as follows

$sparql = $this->get('easyrdf.sparql.connection');
$select = 'select * {?s ?p ?o} limit 100';
$rows = $sparql->query($select);








