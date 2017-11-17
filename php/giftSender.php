<?php
	// Start the session
    session_start();
	include('../class/database.php');
	$database = new Database;
    $database->connect();
    $profileName = $_SESSION['user'];
 
    //Get the values from the GET
    $receiver = $_GET['receiver'];
    $giftTitle = $_GET['giftTitle'];

   	// Prepare the SQL
	$sql = "INSERT INTO user_can_send_gift ( giftSender, giftReceiver ,giftTitle) VALUES (
                                    :giftSender,
                                    :giftReceiver,
                                    :giftTitle
                                     )";
    // Add values
    $values = [
    'giftSender' => $profileName,
    'giftReceiver' => $receiver,
    'giftTitle' => $giftTitle];

    // Call prepared function to execute the above
	$database->prepared($sql,$values);

    // redirect back to mainpage
    header('Location: ../mainpage.php');
?>

