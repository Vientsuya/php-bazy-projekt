<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)
{
  $result = true;

  if (
    !empty($name) &&
    !empty($email) &&
    !empty($username) &&
    !empty($pwd) &&
    !empty($pwdRepeat)
  ) {
    $result = false;
  }

  return $result;
}

function invalidUid($username)
{
  $result = true;

  if (preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = false;
  }

  return $result;
}

function invalidEmail($email)
{
  $result = true;

  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = false;
  }

  return $result;
}

function pwdDontMatch($pwd, $pwdRepeat)
{
  $result = true;

  if ($pwd === $pwdRepeat) {
    $result = false;
  }

  return $result;
}

function uidExists($conn, $username, $email)
{
  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    mysqli_stmt_close($stmt);
    return $row;
  } else {
    $result = false;
    mysqli_stmt_close($stmt);
    return $result;
  }
}

function createUser($conn, $name, $email, $username, $pwd)
{
  $sql = "INSERT INTO users 
  (usersName, usersEmail, usersUid, usersPwd)
  VALUES (?, ?, ?, ?);";

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
  mysqli_stmt_execute($stmt);

  if (isset($_GET["adminpanel"])) {
    header("location: ../adminusers.php?error=none");
    exit();
  } else {
    header("location: ../signup.php?error=none");
    exit();
  }
}

function emptyInputLogin($username, $pwd)
{
  $result = true;

  if (
    !empty($username) &&
    !empty($pwd)
  ) {
    $result = false;
  }

  return $result;
}

function loginUser($conn, $username, $pwd)
{
  $uidExists = uidExists($conn, $username, $username);

  if ($uidExists === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $pwdHashed = $uidExists['usersPwd'];
  $comparedPwd = password_verify($pwd, $pwdHashed);

  if ($comparedPwd === false) {
    header("location: ../login.php?error=wrongpassword");
    exit();
  } else if ($comparedPwd === true) {
    session_start();
    $_SESSION["userid"] = $uidExists["usersId"];
    $_SESSION["useruid"] = $uidExists["usersUid"];
    $_SESSION["userrole"] = $uidExists["usersRole"];
    header("location: ../index.php");
    exit();
  }
}

function getAllPosts($conn)
{
  $sql = "SELECT * FROM posts";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: index.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  mysqli_stmt_close($stmt);
  return $resultData;
}

function getPosts($conn, $sql)
{
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: index.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  mysqli_stmt_close($stmt);
  return $resultData;
}

function checkIfInFavourites($conn, $userId, $postId)
{
  $sql = "SELECT favouritesPostId FROM favourites WHERE favouritesUserId = ?;";

  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: index.php?error=stmtfavouritesfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $userId);

  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  $isInFavourites = false;
  while ($row = mysqli_fetch_assoc($resultData)) {
    if ($row["favouritesPostId"] == $postId) {
      $isInFavourites = true;
    }
  }

  return $isInFavourites;
}

function getAllFavouritesPosts($conn, $userId)
{
  $sql = 'SELECT postsId, postsTitle, postsDesc, postsImg FROM (SELECT favourites.favouritesUserId AS userId, posts.postsId AS postsId, posts.postsTitle AS postsTitle, posts.postsDesc AS postsDesc, posts.postsImg AS postsImg FROM posts INNER JOIN favourites ON favourites.favouritesPostId = posts.postsId) AS kongo WHERE userId = ?;';

  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: index.php?error=stmtfavouritesfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $userId);

  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  return $resultData;
}