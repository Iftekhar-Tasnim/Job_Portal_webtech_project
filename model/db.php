<?php
    error_reporting(E_ALL);
    $host = "127.0.0.1";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "Employify";    

    function getConnection(){
        global $dbname;
        global $dbpass;
        global $dbuser;
        global $host;

        $con = mysqli_connect($host, $dbuser, $dbpass, $dbname);
        
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        return $con;
    }

?>
