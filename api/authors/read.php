<?php

//Instantiate blog post object
$author = new Author($db);

//author query
$result = $author->read();
//Get row count
$num = $result->rowCount();

//Check for authors
if($num > 0) {
    //Author array
    $author_arr = array();
    $author_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $author_item = array(
            'id' => $id,
            'author' => $author,
        );

        //Push data
        array_push($author_arr['data'], $author_item);
    }

    //turn to JSON and output data
    echo json_encode($author_arr);

} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}

?>