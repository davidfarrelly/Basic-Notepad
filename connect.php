<?php
  $servername = "servername_here";
  $username = "username_here";
  $password = "password_here";
  $dbname = "dbname_here";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $_SESSION["connection"] = $conn;
?>
