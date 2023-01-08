<?php

if (isset($_POST["submit"])) {

  require_once "dbh.inc.php";

  if ((empty($_POST["title"]) || empty($_POST["desc"]) || empty($_POST["imgurl"])) && $_GET["action"] == "create") {
    header("location: ../adminposts.php?error=empty");
    exit();
  }

  if (empty($_POST["postid"]) && empty($_POST["title"]) && $_GET["action"] == "delete") {
    header("location: ../adminposts.php?delerror=empty");
    exit();
  }

  if ((empty($_POST["postid"]) || empty($_POST["fieldname"]) || empty($_POST["newvalue"])) && $_GET["action"] == "modify") {
    header("location: ../adminposts.php?moderror=empty");
    exit();
  }


  $stmt = mysqli_stmt_init($conn);

  switch ($_GET["action"]) {
    case 'create':
      $sql = 'INSERT INTO posts (postsTitle, postsDesc, postsImg) VALUES (?, ?, ?);';

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../adminposts.php?error=stmtfailed");
        exit();
      }

      $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

      mysqli_stmt_bind_param($stmt, "sss", $_POST["title"], $_POST["desc"], $_POST["imgurl"]);
      mysqli_stmt_execute($stmt);

      header("location: ../adminposts.php?error=none");
      exit();

    case 'delete':
      $sql = 'DELETE FROM posts WHERE postsId = ? OR postsTitle LIKE ?;';

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../adminposts.php?error=stmtfailed");
        exit();
      }

      mysqli_stmt_bind_param($stmt, "ss", $_POST["id"], $_POST["uid"]);
      mysqli_stmt_execute($stmt);

      mysqli_stmt_close($stmt);
      header("location: ../adminusers.php?delerror=none");
      exit();

    case 'modify':
      $sql = 'UPDATE posts SET ' . $_POST["fieldname"] . ' = ? WHERE postsId = ?;';

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../adminposts.php?error=stmtfailed");
        exit();
      }

      mysqli_stmt_bind_param($stmt, "ss", $_POST["newvalue"], $_POST["postid"]);
      mysqli_stmt_execute($stmt);

      mysqli_stmt_close($stmt);
      header("location: ../adminposts.php?moderror=none");
      exit();
    default:
      # code...
      break;
  }
}