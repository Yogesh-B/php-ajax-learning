<?php
require_once 'database.php';

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];

$sql = "INSERT INTO students(first_name, last_name) VALUES('{$first_name}','{$last_name}')";
// $result = mysqli_query($mysql_conn,$sql) or die("SQL Query Failed.");

if(mysqli_query($mysql_conn,$sql)){
    echo 1;
}else{
    echo 0;
}