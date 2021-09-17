<?php

const servername = "localhost";
const username = "jura";
const password = "ghost";
const dbname = "test";

sqlQuery();

function sqlQuery(){
    $firstname = htmlspecialchars($_POST['fname']);
    $lastname = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    if(!empty($firstname) && !empty($lastname))
    {
      $query = "INSERT INTO myguests (firstname, lastname, email)
      VALUES ('{$firstname}', '{$lastname}', '{$email}')";
    }

  
    // Create connection
    $conn = new mysqli(servername, username, password, dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
  
    if ($conn->query($query) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $query . "<br>" . $conn->error;
    }
  }

$conn->close();
?>