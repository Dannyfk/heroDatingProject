<?php
	// Start the session
    session_start();
	include('../class/database.php');
	$database = new Database;
    $database->connect();
    $profileName = $_SESSION['user'];
 
    //Get the value from the GET
    $receiver = $_GET['receiver'];

   	// Prepare the SQL
	$sql = "INSERT INTO liketable ( likeSender,likeReceiver) VALUES (
                                    :likeSender,
                                    :likeReceiver
                                     )";
    // Add values
    $values = [
    'likeSender' => $profileName,
    'likeReceiver' => $receiver];

    // Call prepared function to execute the above
	$database->prepared($sql,$values);

    // redirect back to mainpage
    header('Location: ../mainpage.php');
?>

