<?php

header('Content-Type: text/plain; charset=UTF-8') ;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require '../../vendor/autoload.php';
require '../config/db.php';


$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);
$app->get('/api/tchala', function (Request $request, Response $response) {
    $query = "select * from Tchala limit 14";

    try{
        
        
                //make connection with the database
                $db = new db();
                $db = $db->connect();
        
                //get data 
                $stmt = $db->query($query);
                $tchala = $stmt->fetchAll(PDO::FETCH_OBJ);
                //utf8_encode($tchala);
                //$tchala = utf8_encode($tchala);
                $db = null;

                $outpout = array('tchala'=>$tchala);
        
                echo json_encode($outpout);
                //echo json_encode($outpout);
        
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }

});


//get single lotto with specific name
$app->get('/api/tchala/{name}', function (Request $request, Response $response) {

    $name = $request->getAttribute('name');

    $query = "select * from tchala where nom = '$name' ";

    try{
        
                //make connection with the database
                $db = new db();
                $db = $db->connect();
        
                //get data 
                $stmt = $db->query($query);
                $tchala = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
        
                $outpout = array('tchala'=>$tchala);
                
                echo json_encode($outpout);
        
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }

});

$app->run();