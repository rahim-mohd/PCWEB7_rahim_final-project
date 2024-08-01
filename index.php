<?php
require "dbconfig/config.php";
?>



<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>SGHalal Cafes</title>
	<link rel="stylesheet" href="style.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

</head>

<body style="background-color:whitesmoke;">
	<?php include("navbar.php"); ?>
	<style>
		body {
			background-color: whitesmoke;
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
		.carousel-item {
			height: 30rem;
			background-position: center;
			background-size: cover;
			width: 600px;
			margin: left 50%;

			

			
		}
		.overlay-image {
			position: absolute;
			bottom: 0;
			left: 150%;
			right: 0;
			top: 0;
			
			background-size: cover;
			width: 100%;
			max-width: 600px;
			opacity: 0.7;
			
			
		}
		/* .carousel-item active{
			align-items: center;
		} */

		


		
	</style>

	<h1>Hello there, world!</h1> 

<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="overlay-image" src="assets/atd.jpg">
			</div>
			<div class="carousel-item">
				<img class="overlay-image" src="assets/positano.jpg"> 
			</div>
			<div class="carousel-item">
				<img class="overlay-image" src="assets/malayancouncil.jpg">
			</div>
			<div class="carousel-item">
				<img class="overlay-image" src="assets/flufstack.jpg">
			</div>
			<div class="carousel-item">
				<img class="overlay-image" src="assets/Tipo.jpg">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>


	<div class="container">
		<div class="row">
			<div class="col-3" id="pname">
				<h1 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">Cafes</h1> 

				<?php
				// fill in the blanks	- Select SQL
				$query = "SELECT title FROM cafes";
				$result = mysqli_query($con, $query);
				while ($row = mysqli_fetch_array($result)) {
					$name = $row['title'];
					echo "<h4> <a style='color:#22223b;' href='index.php?name=$name'> $name <br> </a>
							</h4>";
				}
				if (!$result) {
					printf("error: %s\n", mysqli_error($con));
					exit();
				}


				?>
			</div>
			<div class="col-9">
				<?php
				// fill in the blanks	- player is click, show the description
				if (isset($_GET["name"])) {
					$name = $_GET["name"];
					$query = "SELECT description FROM cafes WHERE title = '$name' ";
					$query_run = mysqli_query($con, $query);
					$row = mysqli_fetch_array($query_run);
					$desc = $row["description"];

					echo
					"<h2 style='background-color:#f1faee;'> $name </h2>
							<p style='background-color:#f1faee;'> $desc <br> </p>";
				} else {
					echo "<h2 style='background-color:#f1faee;'> Share your favourite Cafes! </h2>";
				}



				?>
			</div>
			<div class="col-3" id="picpic">
				<?php
				// fill in the blanks	- display the image
				if (isset($_POST["delete"])) {
					$query = "DELETE FROM cafes WHERE title = '$name' ";
					$query_run = mysqli_query($con, $query);
					if ($query_run) {
						echo "<script> alert('Cafe deleted');
								location.href = 'index.php';
								</script>";
					}
				}

				if (isset($_GET["name"])) {
					$name = $_GET["name"];
					$query = "SELECT Image FROM cafes WHERE title = '$name' ";
					$query_run = mysqli_query($con, $query);
					$row = mysqli_fetch_array($query_run);

					echo '
						<form method= "post" action ="index.php?name=' . $name . '" >
						<div class="btns">
						<input type="button" value="Hide Pic" id="hidebtn">
						<input type="submit" name="delete" value="Delete cafe">
						</div>
						<img id="hide" src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" height="200" />
						</form>';
				}


				?>
			</div>
		</div>
	</div>

	

	<footer class="container-fluid pt-md-5 pb-md-4 pt-4 pb-4">
		
		<div class="container">
			<div class="row">

				
			</div>
		</div>
		<div class="row copy-right mt-md-4 mt-2 mb-2">
			<div class="col-12 text-left text-md-center"><img class="ftr-logo" src="assets/halal.jpg" width=100 height=100 alt="SG Halal Cafe">
				<p class="mb-0">© 2022 SG Halal Cafes.All Rights Reserved.</p>
			</div>
		</div>
		
	</footer>




	<script>
		$("#hidebtn").click(function() {
			$("#hide").toggle(100);
			if ($('#hidebtn').val() === 'Hide Pic') {
				$('#hidebtn').val("Show Pic");
			} else {
				$('#hidebtn').val("Hide Pic");
			}
		});
	</script>

</body>

</html>
