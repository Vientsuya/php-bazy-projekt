<?php
include_once 'header.php';
require_once "includes/dbh.inc.php";
require_once 'includes/functions.inc.php';
?>

<body>
  <section id="popular" class="section section-popular">
    <div class="container">
      <div class="row">
        <?php
        $posts = getAllFavouritesPosts($conn, $_SESSION["userid"]);

        while ($post = mysqli_fetch_assoc($posts)) {
          echo '<div class="col s12 m4">';
          echo '<div class="card">';
          echo '<div class="card-image">';
          echo '<img src="' . $post["postsImg"] . '" alt="' . $post["postsTitle"] . '">';
          echo '<span class="card-title">' . $post["postsTitle"] . '</span>';
          echo '</div>';
          echo '<div class="card-content">' . $post["postsDesc"];
          if (isset($_SESSION["userid"])) {
            echo '<a href="includes/favourites.inc.php?postid=' . $post["postsId"] . '&action=remove&favourites=true"><span class="add-favourites"><i class="material-icons">bookmark</i></span></a>';
          }
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }

        ?>
      </div>
    </div>
  </section>


  <?php
  include_once 'footer.php';
  ?>