<?php
include_once 'header.php';
require_once "includes/dbh.inc.php";
require_once 'includes/functions.inc.php';
?>

<section id="search" class="section section-search blue lighten-3 white-text center scrollspy">
	<div class="container">
		<div class="row">
			<div class="col s12">
				<h3>Search Posts</h3>
				<form method="POST" action="includes/search.inc.php">
					<div class="input-field">
						<input id="autocomplete-input" type="text" name="searchTerm" class="white grey-text autocomplete">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<section id="popular" class="section section-popular">
	<div class="container">
		<div class="row">
			<?php
			if (isset($_GET["searchterm"])) {
				$sql = 'SELECT * FROM posts WHERE postsTitle LIKE "%' . $_GET["searchterm"] . '%" OR postsDesc LIKE "%' . $_GET["searchterm"] . '%";';
				$posts = getPosts($conn, $sql);
			} else {
				$posts = getAllPosts($conn);
			}

			while ($post = mysqli_fetch_assoc($posts)) {
				echo '<div class="col s12 m4">';
				echo '<div class="card">';
				echo '<div class="card-image">';
				echo '<img src="' . $post["postsImg"] . '" alt="' . $post["postsTitle"] . '">';
				echo '<span class="card-title">' . $post["postsTitle"] . '</span>';
				echo '</div>';
				echo '<div class="card-content">' . $post["postsDesc"];
				if (isset($_SESSION["userid"])) {
					if (checkIfInFavourites($conn, $_SESSION["userid"], $post["postsId"])) {
						echo '<a href="includes/favourites.inc.php?postid=' . $post["postsId"] . '&action=remove"><span class="add-favourites"><i class="material-icons">bookmark</i></span></a>';
					} else {
						echo '<a href="includes/favourites.inc.php?postid=' . $post["postsId"] . '&action=add"><span class="add-favourites"><i class="material-icons">bookmark_border</i></span></a>';
					}
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