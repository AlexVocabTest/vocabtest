<?php
    function OpenCon() {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpassword = "";
        $db = "vocabtest";
  
        try {   
            $connection = new mysqli($dbhost, $dbuser, $dbpassword,$db) or die("Connect failed: %s\n". $connection -> error);
            $connection -> set_charset("utf8");

            return $connection;
        } catch (mysqli_sql_exception $e) {
            echo "No connection";
        }
    }

    function CloseCon($connection) {
         $connection -> close();
    }
?>