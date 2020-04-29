<?php
include_once( dirname(__FILE__) . '/../db-connect.php');

function createAnnouncement($title, $desc) {
	$connection = openDatabaseConnection();
	$stmt = $connection->prepare('INSERT INTO announcements(title, description) VALUES(?, ?);');
	$stmt->execute([$title, $desc]);
	$connection = null;
	echo "Table inserted successfully";
}

function getAnnouncements() {	
	$connection = openDatabaseConnection();
	$stmt = $connection->prepare("SELECT title, description FROM announcements;");
	$stmt->execute();
  
	$announcements = $stmt->fetchAll();
	$htmlString = "<div id='announcement-cards'>";
	foreach ($announcements as $announcement) {
		$htmlString .= "<div class='hidden-announcement'>";
		$htmlString .= "<h3>". $announcement['title'] . "</h5>";
		$htmlString .= "<p>". $announcement['description'] . "</p>";
		$htmlString .= "</div>";
	}
	$htmlString .= "</div>";
	echo $htmlString;

	$connection = null;
}
	
function deleteAnnouncement($title){
	$connection = openDatabaseConnection();
	$stmt = $connection->prepare('DELETE FROM announcements WHERE title = ?;');
	$stmt-execute([$title]);
	$connection = null;
	echo "DELETED";
}

function generateCMSAnnouncements() {
  $connection = openDatabaseConnection();
	$stmt = $connection->prepare("SELECT title, description FROM announcements;");
	$stmt->execute();
  
	$announcements = $stmt->fetchAll();
	for($i = 0; $i < count($announcements); $i++) {
		echo '<div class="announcement list-group-item d-flex justify-content-between align-items-center">
				<i class="fas fa-bars drag-handle"></i>
				<div class="d-flex flex-column w-75">
					<input class="title form-control w-50 mb-1" type="text" placeholder="Title" value="' . $announcements[$i]["title"] . '"/>
					<textarea class="description form-control w-100" placeholder="Description...">' . $announcements[$i]["description"] . '</textarea>
				</div>
				<i class="far fa-times-circle delete"></i>
			</div>';
	}
  $connection = null;
}
?>