<?php
  session_start();
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
</head>

<body>
  <div class="container">
    <form id="login_form" method="post" action="notepad.php">
      <textarea id="note" name="note" class="input" placeholder="Add your note here!"></textarea>
      <input type="submit" name="submit" value="Add Note" class="action-btn">
      <input type="button" onclick="location.href='index.php';" value="Logout" class="action-btn"/>
    </form>
  </div>

<?php
  include 'connect.php';

  if(isset($_POST['submit'])) {
    $note=$_POST['note'];
    $date = date("Y/m/d");
    $user = $_SESSION["name"];
    $note = mysqli_real_escape_string($conn, $note);

    $sql = "INSERT INTO $user (note_body, creation_date) VALUES ('$note','$date')";
    if ($conn->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  $user = $_SESSION["name"];

  $sql = "SELECT * FROM $user";
  $result = $conn->query($sql);

  while ($row = mysqli_fetch_array($result)){
  ?>
     <table valign="top">
     <tr>
        <td>
          <a href="?link=<?php echo $row["note_body"];?>" name="link">
            <i class="fa fa-times" aria-hidden="true"></i>
          </a>
        </td>
        <td>
          <?php echo $row["note_body"];?>
        </td>
     </tr>
     </table>
     <?php
    }

    if(isset($_GET['link'])) {
        $link = $_GET['link'];
        $var = $row["note_body"];
        $sql = "DELETE FROM `$user` WHERE `note_body` = '$link'";

        if ($conn->query($sql) === TRUE) {
          header('Location: notepad.php');
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
</body>
</html>
