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

//quote query
$quote->read_single();

//Create array
$quote_arr = array(
    'id' => $quote->id,
    'quote' => $quote->quote,
    'author' => $quote->author,
    'category' => $quote->category
);

//Change to JSON data
print_r(json_encode($quote_arr));

?>