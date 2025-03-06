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
    <th width="90px">Edit</th>
    <th width="90px">Delete</th>
    </tr>
     ';

    while($raw = mysqli_fetch_assoc($result)){
            $output.="
            <tr>
                <td class='id'>{$raw["id"]}</td>
                <td><span class='fname'>{$raw["first_name"]}</span>
<span class='lname'>{$raw["last_name"]}</span>
</td>
                <td><button class='edit-btn' data-id='{$raw["id"]}'>Edit</button></td>
                <td><button class='delete-btn' data-id='{$raw["id"]}'>Delete</button></td>
            </tr>
            ";
    }
    $output .= "</table>";
    mysqli_close($mysql_conn);

    echo $output;
} else {
    echo '<h2>No Record Found!</h2>';
}
