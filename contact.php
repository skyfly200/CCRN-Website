<?php 
	$pagename = "Contact";
	require 'functions.php';
	
	// connect to database
	$servername = "localhost";
	$dbname = "ccrn test";
	$username = "user";
	$password = "password";
	
	$name1 = $email1 = $name2 = $email2 = $title = $type = $url = $text = $subject = $message = $content = $confirm1 = $confirm2 = "";
	$name1Err = $email1Err = $name2Err = $email2Err = $titleErr = $typeErr = $urlErr = $textErr = $fileErr = $subjectErr = $messageErr = "";
	$error = $sent = false;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		if(isset($_POST['contact'])) {
			
			if (empty($_POST["name"])) {
				$name1 = "none";
			} else {
				$name1 = sanitize_input($_POST["name"]);
				if (!preg_match("/^[a-zA-Z ]*$/",$name1)) {
					$name1Err = "Only letters and white space allowed"; 
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
				$messageErr = "*";
				$error = true;
			} else {
				$message = sanitize_input($_POST["message"]);
			}
			
			// use wordwrap() if lines are longer than 70 characters
			$msg = $name1." - ".$email1." \n".wordwrap($message,70);
			$sbj = "CCRN contact-".$subject;

			// send email
			$sent = mail("cocommunityradio@gmail.com",$sbj,$msg);
			if ($sent) {
				$confirm1 = "Message sent";
			} else {
				$confirm1 = "Message failed to send";
			}
		}
		
		else if(isset($_POST['content'])) {
			
			if (isset($_POST["name"])) {
				$name2 = sanitize_input($_POST["name"]);
				if (!preg_match("/^[a-zA-Z0-9 ]*$/",$name2)) {
					$name2Err = "Only letters, numbers and white space allowed"; 
					$error = true;
				}
			} else {
				$name2Err = "Please input your name!";
				$error = true;
			}
			
			if (isset($_POST["email"])) {
				$email2 = sanitize_input($_POST["email"]);
				if (!filter_var($email2, FILTER_VALIDATE_EMAIL)) {
					$email2Err = "Invalid email address!"; 
					$error = true;
				}
			} else {
				$email2Err = "Please input an email!";
				$error = true;
			}
			
			if (isset($_POST["title"])) {
				$title = sanitize_input($_POST["title"]);
				if (!preg_match("/^[a-zA-Z0-9 ]*$/",$title)) {
					$titleErr = "Only letters, numbers and white space allowed"; 
					$error = true;
				}
			} else {
				$titleErr = "Please input a title!";
				$error = true;
			}
			
			if (isset($_POST["type"])) {
				$type = sanitize_input($_POST["type"]);
			}
			
		
			if ($type == "1") {
				if (isset($_POST["type"])) {
					$url = sanitize_input($_POST["url"]);
					if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
						$urlErr = "Invalid URL"; 
						$error = true;
					}
					$content = $url;
				} else {
					$urlErr = "Please input a URL!";
					$error = true;
				}
			}
			
			else if ($type == "2") {
				if (isset($_FILES["fileUpload"])) {
					
					$target_dir = "uploads/";
					$target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
					$file_tmp = $_FILES['fileUpload']['tmp_name'];
					$file_name = $_FILES["fileUpload"]["name"];
					
					// Check if file already exists
					if (file_exists($target_file)) {
						$fileErr = "Sorry, file already exists. If your sure it not been uploaded yet, try renaming it.";
						$error = true;
					}
					
					 // Check file size
					if ($_FILES["fileUpload"]["size"] > 10000000) {
						$fileErr = "Sorry, your file is too large. No files larger than 25MB.";
						$error = true;
					}
					
					// Allow only certain file formats
					if(!ext_check($file_name)) {
						$fileErr = "file extension not allowed";
						$error = true;
					}
					
					// Move file to permanent location
					if (!$error) {
						move_uploaded_file($file_tmp,$target_file);
					}
					
					$content = $target_file;
					
				} else {
					$fileErr = "Please select a file!";
					$error = true;
				}
			}
			
			else if ($type == "3") {
				if (isset($_POST["type"])) {
					$text = sanitize_input($_POST["text"]);
					$content = $text;
				} else {
					$textErr = "Please enter a message!";
					$error = true;
				}
			}
			
			if (!$error) {
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);

				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
				
				// prepare and bind
				$stmt = $conn->prepare("INSERT INTO submited_content (name, email, title, type, content) VALUES (?, ?, ?, ?, ?)");
				$stmt->bind_param('sssis', $name2, $email2, $title, $type, $content);
				$stmt->execute();
				
				// close connection
				$conn->close();
				
				$confirm2 = "Content submited succesfuly";
			}
		}
	}
	
	require 'head.php'; 
	echo "<body>";
	require 'header.php'; 
?>

	<div class="container-fluid">	
		<div class="row">
			<div class="col-md-6">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<div class="form-group">
						<input type="hidden" name="form" value="contact">
						<h3>Contact Us</h3>
						<label>Name:</label><br>
						<input name="name" class="form-control" type="text" placeholder="Name" size="50" autofocus value="<?php echo $name1;?>"></br>
						<span class="error"><?php echo $name1Err;?></span>
						<label>Email:</label><br>
						<input name="email" class="form-control" type="email" placeholder="Email Address" size="50" value="<?php echo $email1;?>"><br>
						<span class="error"><?php echo $email1Err;?></span>
						<label>Subject:</label><br>
						<input name="subject" class="form-control" type="text" placeholder="Subject" size="50" required value="<?php echo $subject;?>"><br>
						<span class="error"><?php echo $subjectErr;?></span>
						<label>Message:</label><br>
						<textarea name="message" class="form-control" rows="4" cols="53" required><?php echo $message;?></textarea><br>
						<span class="error"><?php echo $messageErr;?></span>
						<button type="button" class="btn btn-default btn-lg" name="contact"><span class="glyphicon glyphicon-send" aria-hidden="true"></span>  Send</button>
						<div><?php echo $confirm1 ?></div>
					</div>
				</form>
			</div>
			<div class="col-md-6">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" width="100%">
					<div class="form-group">
						<input type="hidden" name="form" value="content">
						<h3>Send Us New Content</h3>
						<label>Name:</label><br>
						<input name="name" class="form-control" type="text" placeholder="Name" size="50" autofocus required value="<?php echo $name2;?>"></br>
						<span class="error"><?php echo $name2Err;?></span>
						<label>Email:</label><br>
						<input name="email" class="form-control" type="email" placeholder="Email Address" maxlength="254" size="50" required value="<?php echo $email2;?>"><br>
						<span class="error"><?php echo $email2Err;?></span>
						<label>Title:</label><br>
						<input name="title" class="form-control" type="text" placeholder="Title" size="50" required value="<?php echo $title;?>"><br>
						<span class="error"><?php echo $titleErr;?></span>
						<label>Submition Type:</label><br>
						<select name="type" id="type" onchange="formChange()" class="form-control">
							<option value="0" <?php if ($type == "" || $type == "0") { echo "selected='selected'"; } ?>>Choose one</option>
							<option value="1" <?php if ($type == "1") { echo "selected='selected'"; } ?>>URL</option>
							<option value="2" <?php if ($type == "2") { echo "selected='selected'"; } ?>>File Upload</option>
							<option value="3" <?php if ($type == "3") { echo "selected='selected'"; } ?>>Text</option>
						</select>
						<div id="content-field">
							<?php 
								if ($type == "" || $type == "0") { echo "Please select an option from the dropdown above!"; }
								else if ($type == "1") {
									echo '<label>URL:</label><br><input name="url" type="url" placeholder="Content URL" size="50" required value="';
									echo $url;
									echo '"><br><span class="error">';
									echo $urlErr;
									echo '</span><br>'; 
								}
								else if ($type == "2") { 
									echo '<center><label>File:</label><input type="file" name="fileUpload" id="fileUpload" size="50" required></center><br><span class="error">';
									echo $fileErr;
									echo '</span><br>'; 
								}
								else if ($type == "3") { 
									echo '<label>Message:</label><br><textarea name="text" rows="4" cols="53" required>';
									echo $text;
									echo '</textarea><br><span class="error">';
									echo $textErr;
									echo '</span><br>'; 
								}
							?>
						</div>
						<span class="error"><?php echo $typeErr;?></span><br>
						<button type="button" class="btn btn-default btn-lg" name="contact"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Submit</button>
						<div><?php echo $confirm2 ?></div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script>
		function formChange() {
			if (document.getElementById("type").value == "1"){
				document.getElementById("content-field").innerHTML = '<label>Content URL:</label><br><input name="url" type="url" placeholder="Content URL" size="50" required value=""><br><br><span class="error"><?php echo $urlErr;?></span><br>';
			}
			else if (document.getElementById("type").value == "2"){
				document.getElementById("content-field").innerHTML = '<center><label>File:</label><input type="file" name="fileUpload" id="fileUpload" size="50" required></center><br><span class="error"><?php echo $fileErr;?></span><br>';
			}   
			else if (document.getElementById("typec").value == "3"){
				document.getElementById("content-field").innerHTML = '<label>Message:</label><br><textarea name="text" rows="4" cols="53" required></textarea><br><br><span class="error"><?php echo $textErr;?></span><br>';
			}   
			else{
				document.getElementById("content-field").innerHTML = "Please select an option from the dropdown above!<br>";
			}        
		}
	</script>
	
<?php
	require 'footer.php'; 
?>