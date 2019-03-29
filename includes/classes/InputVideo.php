<?php 

class InputVideo
{
	private $con, $uploadedBy;
	public function __construct($con,$uploadedBy)
	{
		$this->con = $con;
		$this->uploadedBy = $uploadedBy;
			$query =  $this->con->prepare("SELECT * FROM users WHERE username = :uploadedBy");
			$query->bindParam(":uploadedBy",$uploadedBy);
			$query->execute();

			$this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
	}
	public function getid()
	{
		return $this->sqlData["id"];
	}	
}

	

?>