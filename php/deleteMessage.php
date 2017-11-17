<?php
	// Start the session
    session_start();
	include('../class/database.php');
	$database = new Database;
    $database->connect();
 
    //Get the value from the GET
    $messageId = $_GET['messageId'];

    //Delete the message with the id from variable
   	$database->deleteMessage($messageId);

    // redirect back to mainpage
    header('Location: ../mainpage.php');
?>

