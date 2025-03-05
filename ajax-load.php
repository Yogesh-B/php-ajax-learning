<?php
require_once 'database.php';


$sql = "SELECT * FROM students";

$result = mysqli_query($mysql_conn, $sql) or die("SQL query failed");
$output = "";


if (mysqli_num_rows($result) > 0) {
    $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
    
    <tr>
    <th width="100px">Id</th>
    <th>Name</th>
    <th width="100px">Delete</th>
    </tr>
     ';

    while($raw = mysqli_fetch_assoc($result)){
            $output.="
            <tr>
                <td>{$raw["id"]}</td>
                <td>{$raw["first_name"]} {$raw["last_name"]}</td>
                <td><button class='delete-btn' data-id='{$raw["id"]}'>Delete</button></td>
            </tr>
            ";
    }
    $output .= "</table>";
    mysqli_close($mysql_conn);

    echo $output;
} else {
    echo '<h2>No Record Found!</h2>';//#WE ARE HERE----1-19:09
}
