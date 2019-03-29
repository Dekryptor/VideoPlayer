<?php 
class SearchResultsProvider
{
	private $con, $userLoggedInObj;

	public function __construct($con, $userLoggedInObj)
	{
		$this->con = $con;
		$this->userLoggedInObj = $userLoggedInObj;
	}

	public function getVideos($item, $orderBy)
	{
		$query = $this->con->prepare("SELECT * FROM videos WHERE title LIKE CONCAT('%',:terms,'%')
			OR uploadedBy LIKE CONCAT('%',:terms,'%') ORDER BY $orderBy DESC");
		$query->bindParam(":terms",$item);
		$query->execute();

		$videos = array();
		while($row = $query->fetch(PDO::FETCH_ASSOC))
		{
			$video = new Video($this->con,$row,$this->userLoggedInObj);
			array_push($videos, $video);
		}

		return $videos;
	}

}
 ?>}
