<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messages</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php 
        // Start the session
        session_start();
        include('class/database.php');
        $database = new Database;
        $database->connect();
        //Get the type og message the user want displayed
        $type = $_GET['type'];
        //Get name from session
        $userName = $_SESSION['user'];

        //Switch to determine which kind of function is needed to select the correct data from the database
        switch ($type) {
            case "comment":
                $messages = $database->getComments($userName);
                break;
            case "privateMessage":
                $messages = $database->getPrivateMessages($userName);
                break;
            case "commentOnProfile":
                $receiver = $_GET['receiver'];
                $picture = $database->getProfilePicture($receiver);
                $messages = $database->getComments($receiver);
                break;
            case "privateMessageAProfile":
                $receiver = $_GET['receiver'];
                $picture = $database->getProfilePicture($receiver);
                $messages = $database->getPrivateMessagesBetweenTwoUsers($receiver, $userName);
                break;
        }

    ?>
    <article class="sendMessageBox">
        <p><?php echo $type ?></p>
    <?php
        if(isset($receiver)){
           ?>
           <img src="image/<?php echo $picture[0]['profilePicture'] ?>" alt="Profile picture">
            <form action="php/sendMessage.php">
                <textarea id = "inputMessage" rows="4" cols="50" name="inputMessage" placeholder="Write a message"></textarea><br>
                <input type='hidden' name='private' value=<?php
                    if($type === "commentOnProfile"){
                        echo 0;
                    }
                    else {
                        echo 1;
                    }
                ?>>
                <input type='hidden' name='receiver' value="<?php echo $receiver;?>"/>
                <input type='hidden' name='type' value="<?php echo $type;?>"/>
                <input type="submit" value="Send">
            </form>
           <?php
        }
        foreach($messages as $row){
            ?>
                <article class="comment">
                    <?php 
                    if($row['messageSender']===$userName || $row['messageReceiver']===$userName){
                        ?>
                        <form action="php/deleteMessage.php">
                                <input class="deleteButton" type="submit" value="x" >
                                <input type='hidden' name='messageId' value="<?php echo $row['id'] ?>"/>
                    </form>
                    <?php
                        }
                    ?>

                    <p class="commentSender"><?php echo $row['messageSender'] ?></p>
                    <p><?php echo $row['messageText'] ?></p>
                </article>
            <?php
        }
    ?>
    <form action="mainpage.php">
            <input type="submit" value="Back">
        </form>
    </article>

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