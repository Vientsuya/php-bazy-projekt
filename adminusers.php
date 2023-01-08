<?php
include_once 'header.php';
?>

<section class="admin-panel-table">
  <div class="container">
    <div class="row">
      <!-- Create User -->
      <div class="col s12 m6">
        <div class="card">
          <div class="card-action blue lighten-3 white-text">
            <h3 class="center-align">Create User</h3>
          </div>

          <div class="card-content">
            <form class="signup-form" action="includes/signup.inc.php?adminpanel=1" method="post">
              <input type="text" name="name" placeholder="Full name...">
              <input type="email" name="email" placeholder="Email...">
              <input type="text" name="uid" placeholder="Username...">
              <input type="password" name="pwd" placeholder="Password...">
              <input type="password" name="pwdrepeat" placeholder="Repeat password...">
              <div class="center-align">
                <button class="waves-effect waves-light btn blue lighten-3" type="submit" name="submit">Sign Up</button>
                <div class="notify-msg">
                  <?php
                  if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                      echo "<p>Fill in all fields!</p>";
                    } else if ($_GET["error"] == "invaliduid") {
                      echo "<p>Choose a proper username!</p>";
                    } else if ($_GET["error"] == "invalidemail") {
                      echo "<p>Choose a proper email!</p>";
                    } else if ($_GET["error"] == "passwordmatch") {
                      echo "<p>Password doesn't match!</p>";
                    } else if ($_GET["error"] == "invaliduid") {
                      echo "<p>Something went wrong, try again!</p>";
                    } else if ($_GET["error"] == "usernametaken") {
                      echo "<p>Username already taken!</p>";
                    } else if ($_GET["error"] == "none") {
                      echo "<p>You have signed up!</p>";
                    }
                  }
                  ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Delete User -->
      <div class="col s12 m6">
        <div class="card">
          <div class="card-action blue lighten-3 white-text">
            <h3 class="center-align">Delete User</h3>
          </div>

          <div class="card-content">
            <form class="signup-form" action="includes/userdbhandlers.inc.php?action=delete" method="post">
              <input type="number" name="id" placeholder="ID...">
              <input type="text" name="uid" placeholder="Username...">
              <div class="center-align">
                <button class="waves-effect waves-light btn blue lighten-3" type="submit" name="submit">Delete</button>
                <div class="notify-msg">
                  <?php
                  if (isset($_GET["delerror"])) {
                    if ($_GET["delerror"] == "empty") {
                      echo "<p>Fill in either an username or ID!<p>";
                    }
                  }
                  ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Modify User -->
        <div class="col s12 m6">
          <div class="card">
            <div class="card-action blue lighten-3 white-text">
              <h3 class="center-align">Modify User</h3>
            </div>

            <div class="card-content">
              <form class="signup-form" action="includes/userdbhandlers.inc.php?action=modify" method="post">
                <input type="number" name="userid" placeholder="User ID...">
                <input type="text" name="fieldname" placeholder="Field Name...">
                <input type="text" name="newvalue" placeholder="New Value...">
                <div class="center-align">
                  <button class="waves-effect waves-light btn blue lighten-3" type="submit"
                    name="submit">Modify</button>
                  <div class="notify-msg">
                    <?php
                    if (isset($_GET["moderror"])) {
                      if ($_GET["moderror"] == "empty") {
                        echo "<p>Fill in all fields!<p>";
                      }
                    }
                    ?>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>