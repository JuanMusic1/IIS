<?php
// modelo
class Book{
        public $name;
        public $year;
}

// crear una instancia y seleccionar el libro a busccar
$book = new Book();
$book -> name = 'test 2';

// initialize SOAP client and call web service function
$client = new SoapClient('https://nagios.bpoconsultores.com.co/eia/soap/server.php?wsdl',['trace' => 1,'cache_wsdl' => WSDL_CACHE_NONE]);
$resp = $client->bookYear($book);

// dump respuesta
var_dump($resp);
?>