<?php
// Start the session
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My profile</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php
        //Include and connect to database
        include('class/database.php');
	    $database = new Database;
        $database->connect();
        $user = $database->getUser($_SESSION['user']);
    ?>

    <form action="php/updateProfile.php">
            <label for="inputName">Superhero name</label>
            <input id="indputName" type="text" name="name" value="<?php echo $user[0]['superheroName'] ?>" />
            <br>
            <label for="inputAge">Age</label>
            <input id="indputAge" type="text" name="age" value="<?php echo $user[0]['age'] ?>" />
            <br>
            <label for="inputPower">Super powers</label>
            <textarea id = "inputPower" rows="4" cols="50" name="power"><?php echo $user[0]['superpower'] ?>
            </textarea>
            <br>
            <label for="inputInterest">Interests</label>
            <textarea id = "inputInterest" rows="4" cols="50" name="interest"><?php echo $user[0]['interest'] ?>
            </textarea>
            <br>
            <label for="inputDatingspot">Favorit datingspot</label>
            <textarea id = "inputDatingspot" rows="4" cols="50" name="datingspot"><?php echo $user[0]['favoritDatingSpot'] ?>
            </textarea>
            <br>
            <label for="inputPicture">Profile picture</label>
            <input id="inputPicture" type="text" name="picture" value="<?php echo $user[0]['profilePicture'] ?>" />
            <br>
            <input type="submit" value="Update">
    </form>

    <form action="mainpage.php">
        <input type="submit" value="Back">
    </form>
</body>
</html>