<?php 
	require_once("includes/classes/ButtonProvider.php");
	class VideoInfoControls 
	{
	
	private $con,$video,$userLoggedInObj;
	public function __construct($video,$userLoggedInObj)
	{
		$this->video = $video;
		$this->userLoggedInObj = $userLoggedInObj;
	}

	
 	public function create()
	{
		$likeButton = $this->createLikeButton();
		$dislikeButton = $this->createdisLikeButton();

		return "<div class = 'controls'>
					$likeButton
					$dislikeButton
				</div>";
 	}

 	private function createLikeButton()
 	{
 		$text = $this->video->getLikes();
 		$videoId = $this->video->getId();
 		$action = "likeVideo(this, $videoId)";
 		$class = "likeButton";

 		$imageSrc = "assets/images/icons/thumbs-up.png";

 		if($this->video->wasLikedBy())
 		{
 			$imageSrc = "assets/images/icons/thumbs-up-active.png";
 		}

 		return ButtonProvider::createButton($text,$imageSrc,$action,$class);



 	}

 	private function createdisLikeButton()
 	{
 		$text = $this->video->getdislikes();
 		$videoId = $this->video->getId();
 		$action = "dislikeVideo(this, $videoId)";
 		$class = "dislikeButton";

 		$imageSrc = "assets/images/icons/thumbs-down.png";

 		if($this->video->wasdislikedBy())
 		{
 			$imageSrc = "assets/images/icons/thumbs-down-active.png";
 		}


 		return ButtonProvider::createButton($text,$imageSrc,$action,$class);
 	}

	}

 ?>