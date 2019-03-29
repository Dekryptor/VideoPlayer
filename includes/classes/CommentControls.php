<?php 
	require_once("ButtonProvider.php");
	class CommentControls 
	{
	
	private $con,$comment,$userLoggedInObj;
	public function __construct($con, $comment, $userLoggedInObj)
	{
		$this->con = $con;
		$this->comment = $comment;
		$this->userLoggedInObj = $userLoggedInObj;
	}

	
 	public function create()
	{
		$replyButton = $this->createReplyButton();
		$likesCount = $this->createLikesCount();
		$likeButton = $this->createLikeButton();
		$dislikeButton = $this->createdisLikeButton();
		$replySection = $this->createReplySection();


		return "<div class = 'controls'>
					$replyButton
					$likesCount
					$likeButton
					$dislikeButton
				</div>
				$replySection";
 	}

 	private function createReplyButton()
 	{
 		$text = "REPLY";
 		$action = "toggleReply(this)";
 		return ButtonProvider::createButton($text, null, $action,null);
 	}



 	private function createLikesCount()
 	{
 		$text = $this->comment->getLikes();

 		if($text==0) $text = "";
 		return "<span class='likesCount'>$text</span>";
 	}


 	private function createReplySection()
 	{
 		$videoId = $this->comment->getVideoId();
	 	$postedBy = $this->userLoggedInObj->getUsername();
	 	$commentId = $this->comment->getId();

	 	$profileButton = ButtonProvider::createUserProfileButton($this->con,$postedBy);

	 	$cancelButtonAction = "toggleReply(this)";
	 	$cancelButton = ButtonProvider::createButton("Cancel",null,$cancelButtonAction,"cancelpostComment");

	 	$postButtonAction = "postComment(this,\"$postedBy\",$videoId,$commentId,\"repliesSection\")";
	 	$postButton = ButtonProvider::createButton("Reply",null,$postButtonAction,"postComment");

	 	return "<div class = 'commentForm hidden'>
		 					$profileButton
		 					<textarea class = 'commentBodyClass' placeholder='Add a public Comment'></textarea>
		 					$cancelButton
	 						$postButton
	 				</div>";
 	}

 	private function createLikeButton()
 	{
 		$videoId = $this->comment->getVideoId();
 		$commentId = $this->comment->getId();
 		$action = "likeComment($commentId,this, $videoId)";
 		$class = "likeButton";

 		$imageSrc = "assets/images/icons/thumbs-up.png";

 		if($this->comment->wasLikedBy())
 		{
 			$imageSrc = "assets/images/icons/thumbs-up-active.png";
 		}

 		return ButtonProvider::createButton("",$imageSrc,$action,$class);



 	}

 	private function createdisLikeButton()
 	{
 		$commentId = $this->comment->getId();
 		$videoId = $this->comment->getVideoId();
 		$action = "dislikeComment($commentId, this, $videoId)";
 		$class = "dislikeButton";

 		$imageSrc = "assets/images/icons/thumbs-down.png";

 		if($this->comment->wasdislikedBy())
 		{
 			$imageSrc = "assets/images/icons/thumbs-down-active.png";
 		}


 		return ButtonProvider::createButton("",$imageSrc,$action,$class);
 	}

	}

 ?>