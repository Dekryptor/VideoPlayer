<?php 

class NavigationMenuProvider
{
	private $con,$userLoggedInObj;

	public function __construct($con, $userLoggedInObj)
	{
		$this->con = $con;
		$this->userLoggedInObj = $userLoggedInObj;
	}

	public function create()
	{
		$menuHtml = $this->createNavItem("Home","assets/images/icons/home.png","index.php");
		$menuHtml .= $this->createNavItem("Trending","assets/images/icons/trending.png","trending.php");
		$menuHtml .= $this->createNavItem("Subscriptions","assets/images/icons/subscriptions.png","subscriptions.php");
		$menuHtml .= $this->createNavItem("Liked Videos","assets/images/icons/thumbs-up.png","likedVideos.php");
		if(User::isLoggedIn())
		{
			$menuHtml .= $this->createNavItem("Settings","assets/images/icons/settings.png","settings.php");
			$menuHtml .= $this->createNavItem("Log Out","assets/images/icons/logout.png","logout.php");
		}

		$menuHtml .= $this->createSubscriptionSection();

		return "<div class = 'navigationItem'>
				$menuHtml
			</div>";
	}

	//create subscriptions section

	public function createNavItem($text,$icon,$link)
	{
		return "<div class = 'navigationItem'>
					<a href='$link'>
						<img src='$icon'>
						<span>$text</span>
					</a>
				</div>
				";
	}

	private function createSubscriptionSection()
	{
		$subscriptions = $this->userLoggedInObj->getSubscriptions();
		$html = "<span class='heading'>Subscriptions</span>";
		foreach ($subscriptions as $sub) {
			$subUsername = $sub->getUsername();
			$html .= $this->createNavItem($sub->getUsername(),$sub->getProfilePic(),"profile.php?username=$subUsername");
		}
		return $html;
	}
}

 ?>