<!DOCTYPE html>
<html>
<head>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="style.css">

<style>
  table {
    width: 100%;
    border-collapse: collapse;
  }

  table, td, th {
    border: 1px solid black;
    padding: 5px;
  }

  th {text-align: left;}
</style>
</head>
<body>
  <div>
  <div class="container">

      <div class="search">
        <div class="src">
          <button onclick="unhide('search')">Search</button>

          <div class="form">
            <form action="/PHP/data.php?" method="post" id="search" name="search" hidden>
              <label for="fname">First name:</label><br>
              <input type="text" id="Sfname" name="fname" value=""><br>
              <label for="lname">Last name:</label><br>
              <input type="text" id="Slname" name="lname" value=""><br>
              <label for="email">Email:</label><br>
              <input type="text" id="Semail" name="email" value=""><br><br>
              <input style="display: none;" name="type" value="search">
              <input type="submit" value="Submit" id="sbm">
            </form>
          </div>
        </div>
        <div class="rst">
          <form action="/PHP/data.php?" method="post" id="reset" name="reset">
            <input style="display: none;" name="type" value="empty">
            <button type="submit" id="rst">Reset</button>
          </form>
        </div>
      </div>
      <br>
      <br>

    

      <div class="form">
      <button onclick="unhide('create')">New row</button>
      <br>
      <br>
        <form action="/PHP/submit.php?" method="post" id="rowCreation" name="rowCreation" hidden>
          <label for="fname">First name:</label><br>
          <input type="text" id="fname" name="fname" required><br>
          <label for="lname">Last name:</label><br>
          <input type="text" id="lname" name="lname" required><br>
          <label for="email">Email:</label><br>
          <input type="text" id="email" name="email"><br><br>
          <input type="submit" value="Submit" id="sbm">
        </form>
      </div>

    </div>

  </div>



<?php

const servername = "localhost";
const username = "jura";
const password = "ghost";
const dbname = "test";


// Create connection
$conn = new mysqli(servername, username, password, dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "<h1>Read from txt file</h1>";

$myfile = fopen("ratfact.txt", "r") or die("Unable to open file!");
// Output one character until end-of-file
while(!feof($myfile)) {
  echo fgetc($myfile);
}
fclose($myfile);

//$conn->close();
//-----------------------------------------------------------------------------------

//search func
if(($_POST['type']) == 'search'){
  
  $firstname = htmlspecialchars($_POST['fname']);
  $lastname = htmlspecialchars($_POST['lname']);
  $email = htmlspecialchars($_POST['email']);

  $sql = "SELECT * FROM myguests
  WHERE firstname LIKE '%{$firstname}%' OR lastname LIKE '{$lastname}' OR email LIKE '{$email}'";
} else {
  $sql = "SELECT * FROM MyGuests";
}
?>


<h2>Custom better php</h2>
<?php

$result = $conn->query($sql);
if ($result->num_rows > 0) {
?>

<table id='guests'>
  <tr>
  <th>Id</th>
  <th>FirstName</th>
  <th>LastName</th>
  <th>Email</th>
  </tr>
<?php
while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['firstname'] ?></td>
    <td><?= $row['lastname'] ?></td>
    <td><?= $row['email'] ?></td>
  </tr>
<?php } ?>
</table>
<?php } $conn->close();?>


<script>
  function unhide(tForm){
    if(tForm == 'create'){
      let form = document.getElementById('rowCreation');
      form.removeAttribute('hidden');
    } else if(tForm == 'search'){
      let form = document.getElementById('search');
      form.removeAttribute('hidden');
    }

  }

  $('#rowCreation').submit(function(e){
    e.preventDefault();
    $.ajax({
        url: '/PHP/submit.php?',
        type: 'post',
        data:$('#rowCreation').serialize(),
        success:function(){
            location.reload();
        }
    });
});

</script>
  </body>
</html>