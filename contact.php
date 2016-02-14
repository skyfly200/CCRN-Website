<?php 
	$pagename = "Contact";
	
	// import helper functions
	require 'functions.php';
	
	// declare variables for the form data and errors
	$name1 = $email1 = $name2 = $email2 = $title = $type = $url = $text = $subject = $message = $content = $confirm1 = $confirm2 = "";
	$name1Err = $email1Err = $name2Err = $email2Err = $titleErr = $typeErr = $urlErr = $textErr = $fileErr = $subjectErr = $messageErr = "";
	$error = $sent = false;
	
	// process data from POST request
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// process the contact form submission
		if(isset($_POST['contact'])) {
			
			if (empty($_POST["name"])) {
				$name1 = "none";
			} else {
				$name1 = sanitize_input($_POST["name"]);
				if (!preg_match("/^[a-zA-Z0-9- ]*$/",$name1)) {
					$name1Err = "Only letters, numbers and white space allowed"; 
					$error = true;
				}
			}
			
			if (empty($_POST["email"])) {
				$email1 = "none";
			} else {
				$email1 = sanitize_input($_POST["email"]);
				if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
					$email1Err = "Invalid email address!"; 
					$error = true;
				}
			}
			
			if (empty($_POST["subject"])) {
				$subjectErr = "*";
				$error = true;
			} else {
				$subject = sanitize_input($_POST["subject"]);
				if (!preg_match("/^[a-zA-Z0-9 ]*$/",$subject)) {
					$subjectErr = "Only letters, numbers and white space allowed"; 
					$error = true;
				}
			}
				
			if (empty($_POST["message"])) {
				$messageErr = "Please enter a message!";
				$error = true;
			} else {
				$message = sanitize_input($_POST["message"]);
			}
				
			// use wordwrap() if lines are longer than 70 characters
			$timestamp = date("h:i:sa l, Y/m/d");
			$msg = "Name: ".$name1."\nEmail: ".$email1."\nTime: ".$timestamp."\n\n".wordwrap($message,70);
			$sbj = "website contact form - ".$subject;

			// send the email
			$sent = mail("cocommunityradio@gmail.com",$sbj,$msg);
			// notify the user of success of fail
			if ($sent) {
				$confirm1 = "Message sent";
			} else {
				$confirm1 = "Message failed to send";
			}
		}
	}
	
	// import html head section
	require 'head.php'; 
	// start html body section
	echo "<body>";
	// inport header
	require 'header.php'; 
?>

	<div class="container-fluid">	
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  autocomplete="on">
					<div class="form-group">
						<input type="hidden" name="form" value="contact">
						<h3>Contact Us</h3>
						<label>Name:    </label>
						<input name="name" class="form-control" type="text" placeholder="Name" size="50" autofocus value="<?php if ($error) echo $name1;?>">
						<span class="help-block error"><?php echo $name1Err;?></span>
						<label>Email:    </label>
						<input name="email" class="form-control" type="email" placeholder="Email Address" size="50" value="<?php if ($error) echo $email1;?>">
						<span class="help-block error"><?php echo $email1Err;?></span>
						<label>Subject:   </label>
						<input name="subject" class="form-control" type="text" placeholder="Subject" size="50" value="<?php if ($error) echo $subject;?>" required>
						<span class="help-block error"><?php echo $subjectErr;?></span>
						<label>Message:   </label>
						<textarea name="message" class="form-control" rows="4" cols="53" required><?php if ($error) echo $message;?></textarea>
						<span class="help-block error"><?php echo $messageErr;?></span>
						<button type="submit" class="btn btn-default btn-lg" name="contact"><span class="glyphicon glyphicon-send" aria-hidden="true"></span>  Send</button>
						<div><?php echo $confirm1 ?></div>
					</div>
				</form>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	
<?php
	require 'footer.php'; 
?>