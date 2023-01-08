<?php

session_start();

require_once "dbh.inc.php";

if ($_GET["action"] == "add") {
  $sql = "INSERT INTO favourites 
  (favouritesUserId, favouritesPostId)
  VALUES (?, ?);";

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ii", $_SESSION["userid"], $_GET["postid"]);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

} else if ($_GET["action"] == "remove") {
  $sql = "DELETE FROM favourites 
  WHERE favouritesUserId = ? AND favouritesPostId = ?;";

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ii", $_SESSION["userid"], $_GET["postid"]);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

if (isset($_GET["favourites"])) {
  header("location: ../favourites.php?error=none");
} else {
  header("location: ../index.php?error=none");
}
exit();