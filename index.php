<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hero dating site</title>
</head>
<body>
    <h1>Hello and welcome to superdating</h1>
    <p>Select a profile</p>
<?php
    //Include and connect to database
    include('class/database.php');
	    $database = new Database;
        $database->connect();
        //Create a variable containing the users
        $users = $database->getUsers();
    ?>
        <!-- A form with a select containing all the users. After selecting a user the button redirects to the mainpage as that user -->
        <form action="mainpage.php">
            <select name="users">
                <?php
                    foreach ($users as $row){
                ?>
                    <option value="<?php echo $row['superheroName'] ?>"><?php echo $row['superheroName'] ?></option>
                <?php    
                    }
                ?>
             </select>
            <input type="submit" value="Select">
        </form>
    <?php
 ?>
</body>
</html>