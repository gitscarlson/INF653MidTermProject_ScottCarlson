<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//required files
require('../../config/Database.php');
require('../../models/Quote.php');

//Database
$database = new Database();
$db = $database->connect();

//Instantiate quote object
$quote = new Quote($db);

//Get id from URL
$quote->id = isset($_GET['id']) ? $_GET['id'] : die();
$quote->author_id = isset($_GET['author_id']) ? $_GET['author_id'] : die();
$quote->category_id = isset($_GET['category_id']) ? $_GET['category_id'] : die();

if(isset($_GET['id']) or isset($_GET['author_id']) or isset($_GET['category_id'])){

    //quote query
    $quote->read_single();


    //Create array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author,
        'category' => $quote->category
    );

    if($quote->author !== null){
        //Change to JSON data
        print_r(json_encode($quote_arr, JSON_NUMERIC_CHECK));
        }

    else
        {
            echo json_encode(
                array('message' => 'No Quotes Found')
            );
        }
}
else {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}



?>