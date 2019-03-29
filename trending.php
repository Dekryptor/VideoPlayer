<?php 
require_once("includes/header.php");
require_once("includes/classes/TrendingProvider.php");

$trendProvider = new TrendingProvider($con, $userLoggedInObj);
$videos = $trendProvider->getVideos();

$videoGrid = new VideoGrid($con, $userLoggedInObj);


 ?>

 <div class = "largeVideoGridContainer">
 	<?php
 		if(sizeof($videos)>0)
 		{
 			echo $videoGrid->createLarge($videos,"Trending videos uploaded in the last week",false);
 		}
 		else{
 			echo "no Trending videos to show";
 		}
 	?>

 </div>