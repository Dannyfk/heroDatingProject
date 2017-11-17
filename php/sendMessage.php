<?php
	// Start the session
    session_start();
	include('../class/database.php');
	$database = new Database;
    $database->connect();
    $profileName = $_SESSION['user'];
    $receiver = $_GET['receiver'];
    $private = $_GET['private'];
    //They type is needed when going back to the message page to determin whitch type of message should be displayed
    $type = $_GET['type'];
 
    //Get the values from the inputs and sanitize them
    $message = filter_input(
        INPUT_GET, 'inputMessage', FILTER_SANITIZE_STRING);

       	// Prepare the SQL
	    $sql = "INSERT INTO message (messageReceiver, messageSender ,private, messageText) VALUES (
                                                                                                :messageReceiver,
                                                                                                :messageSender,
                                                                                                :private,
                                                                                                :messageText
                                                                                                )";
        // Add values
        $values = [
        'messageReceiver' => $receiver,
        'messageSender' => $profileName,
        'private' => $private,
        'messageText' => $message];

        // Call prepared function to execute the above
        $database->prepared($sql,$values);

        // redirect back to the message page
        header('Location: ../message.php?type='.$type.'&receiver='.$receiver.'');    

?>

