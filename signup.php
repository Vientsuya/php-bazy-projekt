<?php
include_once 'header.php';
?>

<section class="signup-section">
  <div class="row">
    <div class="col s12 m4 offset-m4">
      <div class="card">
        <div class="card-action blue lighten-3 white-text">
          <h3 class="center-align">Sign Up</h3>
        </div>
        <div class="card-content">
          <form class="signup-form" action="includes/signup.inc.php" method="post">
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
    </form>
  </div>
</section>

<?php
include_once 'footer.php';
?>