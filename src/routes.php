<?php

use Slim\Http\Request;
use Slim\Http\Response;
// Set up Constants
require __DIR__ . '/../src/Querys.php';

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
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
               echo json_encode($result);            
           }
           catch (PDOException $e){
               echo $e->getMessage();
           }
       });
        $app->get('/clientes/[{clave}]',  function (Request $request, Response $response, array $args){
           try{
               $db= new Db();
               $result=$db->query(GET_CLIENTS_BY_CLAVE,array(":clave"=>$args['clave']));
               echo json_encode($result);            
           }
           catch (PDOException $e){
               echo $e->getMessage();
           }
       });
});