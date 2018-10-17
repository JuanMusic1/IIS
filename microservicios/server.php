<?php
// apagar el cache del WSDL
ini_set("soap.wsdl_cache_enabled","0");

// ejemplo de clase
class Book{
        public $name;
        public $year;
}

// regresar el año de un libro por nombre
function bookYear($book){
        // lista de libros
        $_books=[
                ['name'=>'test 1','year'=>2011],
                ['name'=>'test 2','year'=>2012],
                ['name'=>'test 3','year'=>2013],
        ];
        // busqueda por nombre
        foreach($_books as $bk)
                if($bk['name']==$book->name)
                        return $bk['year']; // libro encontrado

        return 0; // libro no encontrado
}

// inicializar el SOAP Server
$server = new SoapServer("test.wsdl",[
        'classmap'=>[
                'book'=>'Book', // 'book' conexion entre el WSDL y la clase PHP
        ]
]);

// registro de las funciones disponibles
$server->addFunction('bookYear');

// inicio de la recepcion de mensajes
$server->handle();

?>