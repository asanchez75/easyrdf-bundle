It is a forked version from conjecto/easyrdf-bundle.
It implements autoload for psr-4 and add a parameter to initialize the Client service.

Usage

1) Install using

composer require asanchez75/easyrdf-bundle

2) Define a global parameter sparql_endpoint in your file app/config/config.yml

parameters:
    sparql_endpoint: http://localhost:8890/sparql

Be aware that the parameter %sparql_endpoint% is used in the file

https://github.com/asanchez75/easyrdf-bundle/blob/master/Resources/config/services.xml

3) Add the bundle to your file app/AppKernel.php

new Conjecto\Bundle\EasyRdfBundle\EasyRdfBundle();

4) Load your service as follows

$sparql = $this->get('easyrdf.sparql.connection');
$select = 'select * {?s ?p ?o} limit 100';
$rows = $sparql->query($select);








