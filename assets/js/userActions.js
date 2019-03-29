function subscribe(userTo, userFrom,button)
{
	if(userTo == userFrom)
	{
		alert("You can't subscribe to yourself");
	}

	$.post("ajax/subscribe.php",{userTo:userTo,userFrom:userFrom})
	.done(function(count){
		if(count!=null)
		{
			console.log(count);
			$(button).toggleClass("subscribe unsubscribe");

			var buttonText = $(button).hasClass("subscribe")? "SUBSCRIBE":"SUBSCRIBED";

			$(button).text(buttonText + " " + count);
		}
		else
		{
			alert("Something went wrong");
		}
	});
}