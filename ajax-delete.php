<?php
require_once 'database.php';

$id = $_POST["id"];

$sql = "DELETE FROM students WHERE id = {$id}";

if(mysqli_query($mysql_conn,$sql)){
    echo 1;
}else{
    echo 0;
}