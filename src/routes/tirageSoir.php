<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../vendor/autoload.php';
require '../config/db.php';


$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);
$app->get('/api/tirageSoir', function (Request $request, Response $response) {
    $query = "select * from TirageSoir limit 20";

    try{
        
                //make connection with the database
                $db = new db();
                $db = $db->connect();
        
                //get data 
                $stmt = $db->query($query);
                $tirage = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;

                $outpout = array('tirageSoir'=>$tirage);
        
                echo json_encode($outpout);
        
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }

});

//get single lotto with specific name
$app->get('/api/tirageSoir/{date}', function (Request $request, Response $response) {

    $date = $request->getAttribute('date');

    $query = "select * from tirageSoir where dateTirage = '$date' ";

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