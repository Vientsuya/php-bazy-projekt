<?php
include_once 'header.php';
?>

<section class="login-section">
  <div class="row">
    <div class="col s12 m4 offset-m4">
      <div class="card">
        <div class="card-action blue lighten-3 white-text">
          <h3 class="center-align">Login</h3>
        </div>

        <div class="card-content">
          <form class="login-form" action="includes/login.inc.php" method="post">
            <input type="text" name="name" placeholder="Username/Email...">
            <input type="password" name="pwd" placeholder="Password...">
            <div class="center-align">
              <button class="waves-effect waves-light btn blue lighten-3" type="submit" name="submit">
                Login
              </button>

              <div class="notify-msg">
                <?php
                if (isset($_GET["error"])) {
                  if ($_GET["error"] == "emptyinput") {
                    echo "<p>Fill in all fields!</p>";
                  } else if ($_GET["error"] == "wronglogin") {
                    echo "<p>Entered Login/Email doesn't exist!</p>";
                  } else if ($_GET["error"] == "wrongpassword") {
                    echo "<p>Entered password is wrong!</p>";
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
</section>



<?php
include_once 'footer.php';
?>