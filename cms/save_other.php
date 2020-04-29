<?php
	include('../db-connect.php');

	function createAbout($about){
		$conn = openDatabaseConnection();
		if(is_null($conn)){
			echo 'Could not connect to database';
			http_response_code(500);
			return;
		}
		$sql = "UPDATE cms_data SET sectionText='$about' WHERE sectionName = 'about'";
		$conn->exec($sql);
		echo "Data changed successfully";
		
	}

	function createHours($hours){
		$conn = openDatabaseConnection();
		if(is_null($conn)){
			echo 'Could not connect to database';
			http_response_code(500);
			return;
		}
		$sql = "UPDATE cms_data SET sectionText='$hours' WHERE sectionName = 'hours'";
		$conn->exec($sql);
		echo "Data changed successfully";
		
	}

	function createCatering($catering){
		$conn = openDatabaseConnection();
		if(is_null($conn)){
			echo 'Could not connect to database';
			http_response_code(500);
			return;
		}
		$sql = "UPDATE cms_data SET sectionText='$catering' WHERE sectionName = 'catering'";
		$conn->exec($sql);
		echo "Data changed successfully";
		
	}

	$_POST = json_decode(file_get_contents('php://input'), true);
	if (isset($_POST['catering'])){
		createCatering($_POST['catering']);
	}
	if (isset($_POST['hours'])){
		createHours($_POST['hours']);
	}
	if (isset($_POST['about'])){
		createAbout($_POST['about']);
	}
	else {
		print_r($_POST);
	}

?>
