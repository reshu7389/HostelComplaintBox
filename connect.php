<?php

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "revisedhostelcomplaint";

$conn = mysqli_connect($servername , $username , $password , $databasename);

if($conn)
{ 
   // echo "Connnection Ok" ;
}
else { 
    echo "Connection Failed" .mysqli_connect_error();
}

?>