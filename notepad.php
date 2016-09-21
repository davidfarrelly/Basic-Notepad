<?php
  session_start();
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>

<body>
  <div class="container">
    <form id="login_form" method="post" action="notepad.php">
      <input type="text" name="note_name" class="input" placeholder="Name your note!"><br>
      <textarea id="note" name="note" class="input" placeholder="Add your note here!"></textarea>
      <input type="submit" name="submit" value="Add Note">
    </form>
  </div>

<?php
  include 'connect.php';

  if(isset($_POST['submit'])) {
    $note=$_POST['note'];
    $date = date("Y/m/d");
    $name = $_POST['note_name'];
    $user = $_SESSION["name"];
    //$sql = "SELECT username,password FROM user_details WHERE username='$name' AND password='$pass'";
    $sql = "INSERT INTO $user (note_name, note_body, creation_date) VALUES ('$name','$note','$date')";


    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  ?>
</body>
</html>
