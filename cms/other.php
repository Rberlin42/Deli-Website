<?php
    define('PAGE', 'OTHER');
    define('SAVE_METHOD', 'save_other');
	require_once('other_controller.php');
	include_once('cms_auth_controller.php');
?>
<!doctype html>
<html>

 <head>
 	<title>B&D CMS - Other</title>
    <link rel="stylesheet" type="text/css" href="/cms/resources/style.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/b795fdd398.js" crossorigin="anonymous"></script>
    <script src="/cms/resources/other-script.js"></script>
 </head>

 <body>
 	<?php include('resources/navbar.php'); ?>

	<div class="container-fluid my-5 px-5" id="other-container">
		<div class="row">
			<div class="col-md mb-5">
				<h2>About</h2>
				<textarea id="about" class="form-control w-100" placeholder="About..." rows="5"><?php echo getAbout(); ?></textarea>
			</div>
			<div class ="col-md mb-5">
				<h2>Hours</h2>
				<textarea id="hours" class="form-control w-100" placeholder="Deli hours..." rows="5"><?php echo getHours(); ?></textarea>
			</div>
			<div class ="col-md mb-5">
				<h2>Catering Info</h2>
				<textarea id="catering" class="form-control w-100" placeholder="Catering info..." rows="5"><?php echo getCateringInfo(); ?></textarea>
			</div>
		</div>
	</div>

	<?php include('resources/savebar.php'); ?>
 </body>
</html>