<?php 

class User
{
	private $con, $sqlData,$username;
	public function __construct($con,$username)
	{
		$this->con = $con;
		$query =  $this->con->prepare("SELECT * FROM users WHERE username = :un");
		$query->bindParam(":un",$username);
		$query->execute();

		$this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
	}

	public static function isLoggedIn()
	{
		return isset($_SESSION["userLoggedIn"]);
	}

	public function getUsername()
	{
		return $this->sqlData["username"];
	}

	public function getName()
	{
		return $this->sqlData["firstName"]." ".$this->sqlData["lastName"];
	}

	public function getFirstName()
	{
		return $this->sqlData["firstName"];
	}

	public function getLastName()
	{
		return $this->sqlData["lastName"];
	}

	public function getEmail()
	{
		return $this->sqlData["email"];
	}

	public function getProfilePic()
	{
		return $this->sqlData["profilePic"];
	}

	public function getSignUpDate()
	{
		return $this->sqlData["signUpDate"];
	}

    public function isSubscribedTo($userToId) {
       $query = $this->con->prepare("SELECT * FROM subscribers WHERE userToId =:userToId AND userFrom =:userFrom");
       $query->bindParam(':userToId',$userToId);
       $query->bindParam(':userFrom',$userFrom);
       $userFrom = $this->getUsername();
		$query->execute();
		return $query->rowCount();
    }

    public function getSubscriberCount($userToId) {
        $query = $this->con->prepare("SELECT * FROM subscribers where userToId=:userTo");
        $query->bindParam(":userTo", $userToId);
        $query->execute();
        return $query->rowCount();
    }

    public function getSubscriptions()
    {
    	$query = $this->con->prepare("
    		SELECT username FROM users WHERE id in (SELECT userToId FROM subscribers WHERE userFrom=:userFrom)");
    	$userFrom = $this->getUsername();
    	$query->bindParam(":userFrom",$userFrom);
    	$query->execute();

    	$subs = array();
    	while($row = $query->fetch(PDO::FETCH_ASSOC))
    	{
       		$user = new User($this->con,$row["username"]);
    		array_push($subs, $user);
    	}
    	return $subs;
    }

}

 ?>