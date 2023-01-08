<?php
require_once "dbh.inc.php";

header("location: ../index.php?searchterm=" . $_POST["searchTerm"]);
exit();