<?php
// Start the session
session_start();
//First check if the GET exisit. If it does then we set the username to that GET else get the username from the session user
if (!empty($_GET['users'])) {
    $userName = $_GET['users'];
}
else {
    $userName = $_SESSION['user'];
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dating mainpage</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
    //Include and connect to database
    include('class/database.php');
	    $database = new Database;
        $database->connect();
        //Variables containing the profile picture
        $profilePicture = $database->getProfilePicture($userName);
        //Create a session for with the users name
        $_SESSION["user"] = $userName;

    ?>
    <!-- Creating a box containing info about the user -->
<article class="profileBox">
    <p><?php echo $userName ?></p>
    <img src="image/<?php echo $profilePicture[0]['profilePicture']; ?>" alt="Profile picture"/>
    <form action = "myProfile.php">
        <input type="submit" value="Edit profile">
    </form>
</article>
<!-- Get all the users from the database and ignore the user himself. After that display the info in articles -->
<section id="otherProfilesContainer">
    <h3>Find another superhero</h3>
    <?php
        $users = $database->getUsers();
        foreach ($users as $row){
            if($row['superheroName']!== $userName){
                ?>
                <article>
                    <img src="image/<?php echo $row['profilePicture']; ?>" alt="Profile picture"/>
                    <p>Name: <?php echo $row['superheroName']; ?></p>
                    <p>Age: <?php echo $row['age']; ?></p>
                    <p>Superpowers: <?php echo $row['superpower']; ?></p>
                    <p>Interests: <?php echo $row['interest']; ?></p>
                    <p>Favorit dating location: <?php echo $row['favoritDatingSpot']; ?></p>
                    <aside>
                        <p>Latest comment:</p>
                        <p>Comment placeholder</p>
                        <form action="">
                        <input type="submit" value = "Comment">
                    </form>
                    </aside>
                    <form action="">
                        <input type="submit" value = "Send private Message">
                    </form>
                    <form action="">
                        <input type="submit" value = "Like">
                    </form>
                    <form action="">
                        <input type="submit" value = "Send gift">
                    </form>
                </article>
                <?php
            }
        }
    ?>    
</section>
    
</body>
</html>