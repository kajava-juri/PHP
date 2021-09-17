<?php

const servername = "localhost";
const username = "jura";
const password = "ghost";
const dbname = "test";



function sqlQuery(){
    $firstname = htmlspecialchars($_POST['fname']);
    $lastname = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    $query = "SELECT firstname, lastname, email FROM myguests
    WHERE firstname LIKE '%{$firstname}%' OR lastname LIKE '{$lastname}' OR email LIKE '{$email}'";
  
  }

?>