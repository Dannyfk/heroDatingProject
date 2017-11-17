<?php
	// Start the session
    session_start();
	include('../class/database.php');
	$database = new Database;
    $database->connect();
    $profileName = $_SESSION['user'];
 
    //Get the values from the inputs and sanitize them
    $name = filter_input(
        INPUT_GET, 'name', FILTER_SANITIZE_STRING);
    $age = filter_input(
        INPUT_GET, 'age', FILTER_SANITIZE_STRING);
    $power = filter_input(
        INPUT_GET, 'power', FILTER_SANITIZE_STRING);
    $interest = filter_input(
        INPUT_GET, 'interest', FILTER_SANITIZE_STRING);
    $datingspot = filter_input(
        INPUT_GET, 'datingspot', FILTER_SANITIZE_STRING);
    $picture = filter_input(
        INPUT_GET, 'picture', FILTER_SANITIZE_STRING);

	// Prepare the SQL
	$sql = "UPDATE user SET 
							superheroName = :superheroName, 
							age = :age, 
							superpower = :superpower, 
							interest = :interest, 
							favoritDatingSpot = :favoritDatingSpot, 
                            profilePicture = :profilePicture
                            WHERE superheroName = '$profileName'";
	// Add values
	$values = [
        'superheroName' => $name,
        'age' => $age,
        'superpower' => $power,
        'interest' => $interest,
        'favoritDatingSpot' => $datingspot,
        'profilePicture' => $picture
        ];

	// Call prepared function to execute the above
	$database->prepared($sql,$values);

    // set session with the name incase it was changed
    $_SESSION['user'] = $name;

    // redirect back to mainpage
    header('Location: ../mainpage.php');
?>

