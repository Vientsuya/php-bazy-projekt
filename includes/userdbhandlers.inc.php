<?php

if (isset($_POST["submit"])) {

  if (empty($_POST["id"]) && empty($_POST["uid"]) && $_GET["action"] == "delete") {
    header("location: ../adminusers.php?delerror=empty");
    exit();
  }

  if ((empty($_POST["id"]) || empty($_POST["fieldname"]) || empty($_POST["newvalue"])) && $_GET["action"] == "modify") {
    header("location: ../adminusers.php?moderror=empty");
    exit();
  }

  require_once 'dbh.inc.php';

  $stmt = mysqli_stmt_init($conn);

  switch ($_GET["action"]) {
    case 'delete':
      $sql = 'DELETE FROM users WHERE usersId = ? OR usersUid LIKE ?;';

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../adminusers.php?error=stmtfailed");
        exit();
      }

      mysqli_stmt_bind_param($stmt, "ss", $_POST["id"], $_POST["uid"]);
      mysqli_stmt_execute($stmt);

      mysqli_stmt_close($stmt);
      header("location: ../adminusers.php?delerror=none");
      exit();

    case 'modify':
      $sql = "UPDATE users SET " . $_POST["fieldname"] . "= ? WHERE usersId = ?;";

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../adminusers.php?error=stmtfailed");
        exit();
      }

      mysqli_stmt_bind_param($stmt, "ss", $_POST["newvalue"], $_POST["userid"]);
      mysqli_stmt_execute($stmt);

      mysqli_stmt_close($stmt);
      header("location: ../adminusers.php?moderror=none");
      exit();
    default:
      # code...
      break;
  }
}