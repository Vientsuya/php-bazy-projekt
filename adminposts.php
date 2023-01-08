<?php
include_once 'header.php';
?>

<section class="admin-panel-table">
  <div class="container">
    <div class="row">
      <!-- Create Post -->
      <div class="col s12 m6">
        <div class="card">
          <div class="card-action blue lighten-3 white-text">
            <h3 class="center-align">Create Post</h3>
          </div>

          <div class="card-content">
            <form class="signup-form" action="includes/postsdbhandlers.inc.php?action=create" method="post">
              <input type="text" name="title" placeholder="Title...">
              <input type="text" name="desc" placeholder="Description...">
              <input type="text" name="imgurl" placeholder="Url to the image...">
              <div class="center-align">
                <button class="waves-effect waves-light btn blue lighten-3" type="submit" name="submit">Create
                  Post</button>
                <div class="notify-msg">
                  <?php
                  if (isset($_GET["error"])) {
                    if ($_GET["error"] == "empty") {
                      echo "<p>Fill in all fields!</p>";
                    }
                  }
                  ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Delete Post -->
      <div class="col s12 m6">
        <div class="card">
          <div class="card-action blue lighten-3 white-text">
            <h3 class="center-align">Delete Post</h3>
          </div>

          <div class="card-content">
            <form class="signup-form" action="includes/postsdbhandlers.inc.php?action=delete" method="post">
              <input type="number" name="postid" placeholder="Post ID...">
              <input type="text" name="uid" placeholder="Title...">
              <div class="center-align">
                <button class="waves-effect waves-light btn blue lighten-3" type="submit" name="submit">Delete</button>
                <div class="notify-msg">
                  <?php
                  if (isset($_GET["delerror"])) {
                    if ($_GET["delerror"] == "empty") {
                      echo "<p>Fill in either Post ID or Title of the post!<p>";
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
        <!-- Modify Post -->
        <div class="col s12 m6">
          <div class="card">
            <div class="card-action blue lighten-3 white-text">
              <h3 class="center-align">Modify Post</h3>
            </div>

            <div class="card-content">
              <form class="signup-form" action="includes/postsdbhandlers.inc.php?action=modify" method="post">
                <input type="number" name="postid" placeholder="Post ID...">
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