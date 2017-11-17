<?php

class Database {

	public $connection; // this stores the connection

	// Create a connection
	public function connect() {

		$servername = "localhost";
		$username = "root";
		$password = "122333";
		$databasename = "heroDating";

		try {
		    $this->connection = new PDO("mysql:host=$servername;dbname=".$databasename, $username, $password);
		    // set the PDO error mode to exception
		    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    }
		catch(PDOException $e) {
		    echo "Database connection failed: " . $e->getMessage();
		    die();
	    }
	}	

	// To be used for all SELECT and DELETE (no prepared statements)
	public function query($sql) {
		$query = $this->connection->query($sql);
		return $query->fetchAll();
	}

	// Query to DELETE without returning anything
	public function onlyQuery($sql){
		$this->connection->query($sql);
	}


	// To be used for all prepared statements
	// 	$sql [string] - The sql to be prepared with palceholders
	// 	$values [array] - The values to binded to the placeholders
	public function prepared($sql,$values) {
		try {
			$statement = $this->connection->prepare($sql);
			$statement->execute($values);
		}
		catch(PDOException $e) {
		    echo "Could not perform prepared statements: " . $e->getMessage();
		    die();
	    }

	}

	public function getUser($name){
		$sql = "SELECT * FROM user WHERE superheroName = '$name'";
		return $this->query($sql);
	}
	
	public function getUsers(){
		$sql = "SELECT * FROM user";
		return $this->query($sql);
	}

	public function getProfilePicture($name){
		$sql = "SELECT profilePicture FROM user WHERE superheroName = '$name'";
		return $this->query($sql);
	}

	public function getLikeAmount($name){
		$sql = "SELECT COUNT(id) AS amount FROM liketable WHERE likeReceiver = '$name'";
		return $this->query($sql);
	}

	// Insert like into database between two given users
	public function likeProfile($sender, $receiver){
		$sql = "INSERT INTO liketable (likeSender, likeReceiver) VALUES ('$sender','$receiver')";
		$result = $this->query($sql);
	}

	//Given 2 users we check if the user has liked the other one 
	public function likeCheck($user, $otherUser){
		$hasLiked = False;
		$sql = "SELECT COUNT(*) AS amount FROM `liketable` WHERE likeSender = '$user' AND likeReceiver = '$otherUser'";
		$result = $this->query($sql);
		if($result[0]['amount']!= 0){
			$hasLiked = True;
		}
		return $hasLiked;
	}

	public function getGifts(){
		$sql = "SELECT * FROM gift";
		return $this->query($sql);
	}

	//This function takes the user as a parameter. It joins the user and gift table together via user_can_sen_gift and select the gift, sender and receiver
	public function myGiftInventory($receiver){
		$sql = "SELECT user1.superheroName AS sender, user2.superheroName as receiver, gift.title, gift.image 
        FROM user_can_send_gift
        INNER JOIN user user1 on user1.superheroName = user_can_send_gift.giftSender
        INNER JOIN user user2 on user2.superheroName = user_can_send_gift.giftReceiver
        INNER JOIN gift on user_can_send_gift.giftTitle = gift.title
		WHERE  user2.superheroName = '$receiver'";
		
		return $this->query($sql);
	}

	public function getComments($name){
		$sql = "SELECT * FROM message WHERE messageReceiver = '$name' AND private = '0' ORDER BY id DESC" ;
		return $this->query($sql);
	}

	//Get comments for the mainpage with a limit to not clutter the mainpage. Also descending order to get the newest comments
	public function getMainpageComments($name, $limit){
		$sql = "SELECT * FROM message WHERE messageReceiver = '$name' AND private = '0' ORDER BY id DESC LIMIT $limit" ;
		return $this->query($sql);
	}

	public function getPrivateMessages($name){
		$sql = "SELECT * FROM message WHERE messageReceiver = '$name' AND private = '1' ORDER BY id DESC";
		return $this->query($sql);
	}

	public function getPrivateMessagesBetweenTwoUsers($receiver, $sender){
		$sql = "SELECT * FROM message WHERE messageReceiver = '$receiver' AND messageSender = '$sender' AND private = '1' ORDER BY id DESC";
		return $this->query($sql);
	}

	public function getMainpagePrivateMessages($name, $limit){
		$sql = "SELECT * FROM message  WHERE messageReceiver = '$name' AND private = '1' ORDER BY id DESC LIMIT $limit";
		return $this->query($sql);
	}

	public function getProfilePictureAndComments($name){
		$sql = "SELECT * FROM message  WHERE messageReceiver = '$name' AND private = '1' ORDER BY id DESC LIMIT $limit";
		return $this->query($sql);
	}

	public function deleteMessage($id){
		$sql = "DELETE FROM `message` WHERE id = '$id'";
		$this->onlyQuery($sql);
	}
}

?>