
<?php require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoInfoSection.php");
require_once("includes/classes/Comment.php");
require_once("includes/classes/CommentSection.php");

if(!isset($_GET["id"]))
{
	echo "No url passed into page";
	exit();
}

$video = new Video($con,$_GET["id"],$userLoggedInObj);
$video->incrementViews();

 ?>

<script type="text/javascript" src = "assets/js/videoPlayerActions.js"></script>
<script type="text/javascript" src = "assets/js/commentActions.js"></script>

<div class = "watchLeftColumn">
	<?php 
	$videoPlayer = new VideoPlayer($video);
	echo $videoPlayer->create(true);

	$videoInfo = new VideoInfoSection($con,$video,$userLoggedInObj);
	echo $videoInfo->create();

	$CommentSection = new CommentSection($con,$video,$userLoggedInObj);
	echo $CommentSection->create();

	 ?>
</div>

<div class = "suggestions">
		<?php 
			$videoGrid = new VideoGrid($con, $userLoggedInObj);
			echo $videoGrid->create(null,null,false);
		 ?>

</div>
	


<?php require_once("includes/footer.php"); ?>