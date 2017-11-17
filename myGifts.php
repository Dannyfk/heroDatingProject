<?php
// Start the session
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My gifts</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
    //Include and connect to database
    include('class/database.php');
	    $database = new Database;
        $database->connect();
        
        //Get the username from session
        $userName = $_SESSION['user'];

        //Get list of gifts send to the user
        $gifts = $database->myGiftInventory($userName);

        foreach($gifts as $row){
            ?>
                <article class="giftContainer">
                    <img src="image/gift/<?php echo $row['image'] ?>" alt="<?php echo $row['title'] ?>"><br>
                    <p>Received from <?php echo $row['sender']; ?></p>
                </article>
            <?php
        }
    ?>
        <form action="mainpage.php">
            <input type="submit" value="Back">
        </form>
</body>
</html>