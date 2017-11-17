<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gift sender</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    
<?php
	// Start the session
    session_start();
	include('class/database.php');
	$database = new Database;
    $database->connect();
    $profileName = $_SESSION['user'];
 
    //Get the values from the GET
    $receiver = $_GET['receiver'];

    //Get the gifts
    $gifts = $database->getGifts();
    ?>
    <h3>Send a gift to <?php echo $receiver ?></h3>
    <?php
    foreach($gifts as $row){
    ?>
        <article class="giftContainer">
            <form action="php/giftSender.php">
                <img src="image/gift/<?php echo $row['image'] ?>" alt="<?php echo $row['title'] ?>"><br>
                <input type='hidden' name='receiver' value="<?php echo $receiver;?>"/>
                <input type="submit" name='giftTitle' value="<?php echo $row['title'] ?>">
            </form>
        </article>
        <?php
            }
        ?>
        <form action="mainpage.php">
            <input type="submit" value="Back">
        </form>
    <?php
?>

</body>
</html>