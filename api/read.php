<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initializing our api
include_once('../core/initialize.php');

//instantiate post
$post = new Post($db);

//blog post query 
$result = $post->read();

//get the row count
$num = $result->rowCount();

//get the row count $num = $result-›rowcount ();
if ($num > 0) {
    $post_arr = array();
    $post_arr['data'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category name' => $category_name
        );
        array_push($post_arr['data'], $post_item);
    }
    //convert to JSON and output
    // This is the json you are always getting as a response from this endpoint 
    echo json_encode($post_arr);
} else {
    echo json_encode(array('message' => 'No posts found. '));
}
