<?php
// Start the session
session_start();
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>

<body>
  <div class="container">
    <form id="login_form" method="post" action="register.php">
      <input type="text" name="username" class="input" placeholder="Your Username!"><br>
      <input type="password" name="pass" class="input" placeholder="Your Password!"><br>
      <input type="submit" name="submit" value="Register">
    </form>
  </div>

<?php
  include 'connect.php';

  if(isset($_POST['submit'])) {
    $name=$_POST['username'];
    $pass = $_POST['pass'];
    $hash = hash('sha512',$pass);

    $sql = "INSERT INTO user_details (username, password) VALUES ('$name','$hash')";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "CREATE TABLE $name (
      note_name VARCHAR(200) NOT NULL,
      note_body VARCHAR(1000) NOT NULL,
      creation_date DATE,
      note_id INT(11) AUTO_INCREMENT PRIMARY KEY
    )";
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
?>
</body>
</html>
