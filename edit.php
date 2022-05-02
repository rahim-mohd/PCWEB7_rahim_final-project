<?php
require "dbconfig/config.php";
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>SG Halal Cafe</title>
	<link rel="stylesheet" href="style.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<style>

	</style>
</head>

<body style="background-color:#f1faee;">
<style>
		body {
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
	</style>
	<?php include("navbar.php"); ?>
	<?php
	// fill in the blanks	- Update sql for the player name, description, image
	$restaurant = $desc = $oldrestaurant = "";
	if (isset($_POST["edit"])) {
		$oldrestaurant = $_GET["name"];
		$restaurant = $_POST["restaurant"];
		$desc = $_POST["description"];
		$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

		$query = "UPDATE cafes SET title = '$restaurant', description = '$desc', Image = '$file' WHERE title = '$oldrestaurant' ";
		$query_run = mysqli_query($con, $query);

		if (false === $query_run) {
			printf("error: %s\n", mysqli_error($con));
		} else {
			echo "<script> alert('Cafe updated');
			  location.href = 'index.php';
			  </script>";
			exit();
		}

		// if ($query_run) {
		// 	echo "<script> alert('Player updated');
		// 		  location.href = 'edit.php';
		// 		  </script>";
		// } else {
		// 	echo "<script> alert('Player was NOT updated!') </script>";
		// }
	}



	?>

	<div class="container">
		<div class="row">
			<div class="col-3" id="pname">
				<h1>Cafe Names</h1>
				<br>
				<?php
				// fill in the blanks - select
				$query = "SELECT title FROM cafes";
				$result = mysqli_query($con, $query);
				while ($row = mysqli_fetch_array($result)) {
					$name = $row['title'];
					echo "<h4> <a style='color:#22223b;' href='edit.php?name=$name'> $name <br> </a> </h4>";
				}


				?>
			</div>
			<div class="col-9">
				<?php
				// fill in the blanks - select
				if (isset($_GET["name"])) {
					$name = $_GET["name"];
					$query = "SELECT * FROM cafes WHERE title = '$name' ";
					$query_run = mysqli_query($con, $query);
					$row = mysqli_fetch_array($query_run);

					$restaurantname = $row["title"];
					$restaurantdesc = $row["description"];

					echo '<form method="post" enctype="multipart/form-data" action="';
					echo htmlspecialchars("edit.php?name=$name");
					echo '">';
					echo '
                        <h2> Cafe </h2>
                        <input class="player" name="restaurant" value="' . $restaurantname . '">
                        <h2> Description </h2>
                        <input class="desc" name="description" value="' . $restaurantdesc . '">
                        <input type="file" name="image">
                        <input type="submit" name="edit" value="Submit">
                        </form>';
				} else {
					echo '<h2 style="background-color:#f1faee;"> Please pick a cafe to edit! </h2>';
				}



				?>

			</div>
		</div>
	</div>

</body>

</html>