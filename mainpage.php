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

        //Variables from database functions
        $profilePicture = $database->getProfilePicture($userName);
        $likes = $database->getLikeAmount($userName);
        $comments = $database->getMainpageComments($userName,3);
        $privateMessages = $database->getMainpagePrivateMessages($userName,3);

        //Create a session for with the users name
        $_SESSION["user"] = $userName;

    ?>
<!-- Creating a box containing info about the user -->
<article class="profileBox">
    <p><?php echo $userName ?></p>
    <img src="image/<?php echo $profilePicture[0]['profilePicture']; ?>" alt="Profile picture"/>
    <p>Likes: <?php echo $likes[0]['amount'] ?></p>
    <form action = "myProfile.php">
        <input type="submit" value="Edit profile">
    </form>
    <form action = "myGifts.php">
        <input type="submit" value="Gift inventory">
    </form>
</article>

<!-- Comment section -->
<article class="commentBox">
    <p>Profile comments</p>
    <?php
        foreach($comments as $row){
            ?>
                <article class="comment">
                    <form action="php/deleteMessage.php">
                        <input class="deleteButton" type="submit" value="x" >
                        <input type='hidden' name='messageId' value="<?php echo $row['id'] ?>"/>
                    </form>
                    <p class="commentSender"><?php echo $row['messageSender'] ?></p>
                    <p><?php echo $row['messageText'] ?></p>
                </article>
            <?php
        }
    ?>
    <form action="message.php">
        <input type="submit" value = "Se all comments">
        <input type='hidden' name='type' value="comment"/>
     </form>
</article>

<!-- Private message section -->
<article class="commentBox">
    <p>Private message comments</p>
    <?php
        foreach($privateMessages as $row){
            ?>
                <article class="comment">
                <form action="php/deleteMessage.php">
                        <input class="deleteButton" type="submit" value="x" >
                        <input type='hidden' name='messageId' value="<?php echo $row['id'] ?>"/>
                    </form>
                    <p class="commentSender"><?php echo $row['messageSender'] ?></p>
                    <p><?php echo $row['messageText'] ?></p>
                </article>
            <?php
        }
    ?>
    <form action="message.php">
        <input type="submit" value = "Se all private messages">
        <input type='hidden' name='type' value="privateMessage"/>
     </form>
</article>

<!-- Get all the users from the database and ignore the user himself. After that display the info in articles -->
<section id="otherProfilesContainer">
    <h3>Find another superhero</h3>
    <?php
        $users = $database->getUsers();
        foreach ($users as $row){
            if($row['superheroName']!== $userName){
                //Get the amount of likes the profile has
                $likes = $database->getLikeAmount($row['superheroName']);
                //Get variable if the user has liked the profile
                $hasLiked = $database->likeCheck($userName, $row['superheroName']);
                //Get one comment from the profile
                $comment = $database->getMainpageComments($row['superheroName'],1);
                ?>
                <article class="otherProfileBox">
                    <img src="image/<?php echo $row['profilePicture']; ?>" alt="Profile picture"/>
                    <p>Name: <?php echo $row['superheroName']; ?></p>
                    <p>Age: <?php echo $row['age']; ?></p>
                    <p>Superpowers: <?php echo $row['superpower']; ?></p>
                    <p>Interests: <?php echo $row['interest']; ?></p>
                    <p>Favorit dating location: <?php echo $row['favoritDatingSpot']; ?></p>
                    <p>Likes: <?php echo $likes[0]['amount']; ?></p>
                    <aside>
                        <p>Latest comment:</p>
                        <article class="comment">
                        <?php
                        //Add comment to the profile
                        if(empty($comment) === true){
                            ?>
                                <p>Profile has no comments:(</p>
                            <?php
                        }
                        else {
                            if($comment[0]['messageSender']===$userName){
                                ?>
                                <form action="php/deleteMessage.php">
                                <input class="deleteButton" type="submit" value="x" >
                                <input type='hidden' name='messageId' value="<?php echo $row['id'] ?>"/>
                            </form>
                            <?php
                            }
                            ?>
                        <p class="commentSender"><?php echo $comment[0]['messageSender'] ?></p>
                        <p><?php echo $comment[0]['messageText'] ?></p>
                            <?php
                        }
                        ?>
                        </article>
                        <form action="message.php">
                            <input type="submit" value = "Comment">
                            <input type='hidden' name='receiver' value="<?php echo $row['superheroName'];?>"/>
                            <input type='hidden' name='type' value="commentOnProfile"/>
                    </form>
                    </aside>
                    <!-- Send private message form -->
                    <form action="message.php">
                        <input type="submit" value = "Send private Message">
                        <input type='hidden' name='receiver' value="<?php echo $row['superheroName'];?>"/>
                        <input type='hidden' name='type' value="privateMessageAProfile"/>
                    </form>
                    <!-- Send like form -->
                    <form action="php/sendLike.php">
                        <input type="submit" value = "Like">
                        <input type='hidden' name='receiver' value="<?php echo $row['superheroName'];?>"/>
                    </form>
                    <!-- Display send gift form. only shown when the profile has been liked -->
                    <?php 
                        if($hasLiked === true){
                    ?>
                    <form action="sendGiftPage.php">
                        <input type="submit" value = "Send gift">
                        <input type='hidden' name='receiver' value="<?php echo $row['superheroName'];?>"/>
                    </form>
                    <?php
                        }
                    ?>
                </article>
                <?php
            }
        }
    ?>    
</section>
<script src="js/jquery-3.2.1.min.js"></script>
<script>
    //Confirm popup when clicking the delete button
    $(document).ready(function(){
        $(".deleteButton").click(function(){
            return confirm('Are you sure you want to delete this message?');
        });
});
</script>
</body>
</html>