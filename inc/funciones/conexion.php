<?php

$conn = new mysqli('localhost', 'root', '', 'bdvargasramirezleonel');

if($conn->connect_error){
    echo $conn->connect_error;
}
$conn->set_charset('utf8');
// echo "<pre>";
// var_dump($conn->ping());
// echo "</pre>";