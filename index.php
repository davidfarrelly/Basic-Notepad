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
    <form id="login_form" method="post" action="index.php">
      <input type="text" name="username" class="input" placeholder="Your Username!"><br>
      <input type="password" name="pass" class="input" placeholder="Your Password!"><br>
      <input type="submit" name="submit" value="Log in">
    </form>
  </div>

<?php
  include 'connect.php';

  if(isset($_POST['submit'])) {
    $name=$_POST['username'];
    $pass = $_POST['pass'];
    $hash = hash('sha512',$pass);

    $sql = "SELECT username,password FROM user_details WHERE username='$name' AND password='$hash'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Set session variables
      $_SESSION["name"] = $name;
      header('Location: notepad.php');
    }
    else {
      echo "Incorrect username or password. Please try again!";
    }
  }
?>
</body>
</html>
