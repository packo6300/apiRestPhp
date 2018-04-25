<?php

use Slim\Http\Request;
use Slim\Http\Response;
// Set up Constants
require __DIR__ . '/../src/Querys.php';

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("index '/' route");
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->group('/clientes', function () use ($app) {
        /**
        * obtiene la lista de clientes
        */        
       $app->get('/clientes',  function (Request $request, Response $response, array $args){
           try{
               $db= new Db();
               $result=$db->query(GET_CLIENTS,array(":company"=>'ATP'));
               $this->logger->info("clientes Request :".json_encode($request)." Response: ".$response);
               echo json_encode($result);            
           }
           catch (PDOException $e){
               echo $e->getMessage();
           }
        });
        /**
         * Obtiene loo detalles de un cliente segun su clave
         * @example clientes/cliente/C000000250 resgresara un arreglo con los datos del cliente
         * @return array con los datos de cada cliente[clave,nombre,direccion,RecIdDireccion,Sitio,Almacen,CondEntrega,MetodoPago,Bloqueo,ModoEntrega]
         */
        $app->get('/cliente/[{clave}]',  function (Request $request, Response $response, array $args){
           try{
               $db= new Db();
               $result=$db->query(GET_CLIENTS_BY_CLAVE,array(":clave"=>$args['clave']));
               $this->logger->info("cliente Request :".json_encode($request)." Response: ".$response);
               echo json_encode($result);            
           }
           catch (PDOException $e){
               echo $e->getMessage();
           }
       });
       $app->post('/crear',  function (Request $request, Response $response, array $args){
            $emp = json_decode($request->getBody());
            echo json_encode($emp);
       });
       $app->put('/actualizar/{id}',  function (Request $request, Response $response, array $args){
            //$emp = json_decode($request->getBody());
            //echo json_encode($args['id']);
           echo $request->getBody();
       });
});