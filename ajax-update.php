<?php
require_once 'database.php';

$id = $_POST["id"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];

$sql = "UPDATE students SET first_name = '{$first_name}', last_name = '{$last_name}' WHERE id = {$id}";

if(mysqli_query($mysql_conn,$sql)){
    echo 1;
}else{
    echo 0;
}