<?php
	$pagename = "Contact";
	
	// import helper functions
	require 'functions.php';
	
	$message = $confirm = $page = "";
	
	$missingPage = htmlspecialchars($_SERVER["PHP_SELF"]);
	
	// process data from POST request
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// process the contact form submission
		if(isset($_POST['contact'])) {
			
			if (isset($_POST["page"])) {
				$page = htmlspecialchars($_POST['page']);
			}	
			
			if (isset($_POST["message"])) {
				$message = sanitize_input($_POST["message"]);
			}
				
			// use wordwrap() if lines are longer than 70 characters
			$timestamp = date("h:i:sa l, Y/m/d");
			$msg = "Page: ".$page."\nTime: ".$timestamp."\n".wordwrap($message,70);
			$sbj = "broken link form - ".$page;

			// send the email
			$sent = mail("cocommunityradio@gmail.com",$sbj,$msg);
			// notify the user of success of fail
			if ($sent) {
				$confirm = "Broken link reported";
			} else {
				$confirm = "Report Failed: please try the <a href='contact.php'>contact form</a>!";
			}
		}
	}
	 
	$pagename = "404";
	require 'head.php'; 
	echo "<body>";
	require 'header.php'; 
?>

    <div class="container-fluid">
		<div class-"row">
			<h1>File Not Found</h1>
			<br>
			<div class="col-xs-4 col-xs-offset-4">
				<h3>Report a broken link</h3>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<input name="page" class="form-control" type="text" placeholder="What page were you expecting" size="50" required autofocus>
					<input name="message" class="form-control" type="text" placeholder="Enter a message (optional)" size="50" autofocus>
					<br>
					<button type="submit" class="btn btn-default btn-lg" name="contact"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>  Submit Report</button>
					<div><?php echo $confirm ?></div>
				</form>
			</div>
		</div>
	</div>
	
<?php
	require 'footer.php'; 
?>