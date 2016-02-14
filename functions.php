<?php
// database credentials
$servername = "localhost";
$username = "user";
$password = "password";
$dbname = "ccrn test";

// connect to the database
function start_database() {
	// Create database connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check database connection
	if ($conn->connect_error) {
		die("Database connection failed: " . $conn->connect_error);
	}
	 return $conn;
}

// process user inputed data for safety and consistency
function sanitize_input($input) {
	return htmlspecialchars(stripslashes(trim($input)));
}

// check if file extension is one that excepted
function ext_check($fileType) {
	$flag = false;
	$types = array("mp3", "wma", "wav", "wave", "m4a", "aif", "ogg", "m3u", "pls", "avi", "m4v", "wmv", "mp4", "mov", "doc", "docx", "wps", "ppt", "pptx", "xls", "xlsx", "pdf", "xps", "jpg", "tif", "tiff", "png", "bmp", "psd", "gif", "zip", "rar", "7z", "xml", "html", "htm", "csv", "txt", "rtf");
	if (in_array($fileType,$types)) { return true; }
	else { return false; }
}

// get the users ip address
function get_ip() {
	//Just get the headers if we can or else use the SERVER global
	if ( function_exists( 'apache_request_headers' ) ) {
		$headers = apache_request_headers();
	} else {
		$headers = $_SERVER;
	}
	//Get the forwarded IP if it exists
	if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
		$the_ip = $headers['X-Forwarded-For'];
	} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
	) {
		$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
	} else {
		
		$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
	}
	return $the_ip;
}

// set a cookie on the users pc
function set_cookie($name = '', $value='', $lifetime='')
{
	// check how many cookies are set
	$count = count($_COOKIE);
	// determine lifetime
	if (lifetime == '') $lifetime = time() + (86400 * 365); // set cookie for a year by default
	// set cookie
	setcookie($name, $value, $lifetime, "/");
	// return wheter a new cookie was set
	if(count($_COOKIE) > $count) {	return true;  }
	else { return false; }
}

// create new user in dataase
function new_user($conn) {
	$id = 0;
	// create the querry
	$log = get_ip()." - ".time()." : ".$pagename;
	$sql = "INSERT INTO users (visits, visit_log)
	VALUES ( 0, ".$log.")";
	
	// try executing the querry
	if ($conn->query($sql) === TRUE) {
		// read the new id
		$id = $conn->insert_id;
	}
	
	// set cookie for new user id
	set_cookie("user_id", $id);
	
	return $id;
}

// returns current user id if set
// otherwise creates a new user 
// sets a cookie on the users machine
// stores it in the database
function get_user_id($conn)
{
	// check for do not track option
	if (getDntStatus()) return 0; 
	
	// check if user_id cookie is set
	if(isset($_COOKIE["user_id"])) {
		// if so read the id
		$id = $_COOKIE["user_id"];
	}
	
	// create new user in the database
	else {
		$id = new_user($conn);
	}
	// return user id
	return $id;
	
}

// add action log 
function log_user_action($conn, $action)
{
	// check for do not track option first
	if (!getDntStatus()) { 
		
		// get the user id
		$id = get_user_id($conn);
		
		// make sure id is valid
		if ($id > 0) {
			// read users data from database
			$sql = "SELECT visits, visit_log FROM users WHERE id=".$id;
			$result = $conn->query($sql);
			
			// retrieve values from querry
			$row = $result->fetch_assoc();
			
			// modify fields
			$visits = $row["visits"] + 1;
			$log = $row["visit_log"].", ".get_ip()." - ".time()." : ".$action;
			
			// create the update querry
			$update = "UPDATE users (visits, visit_log)
			VALUES (".$visits.", ".$log.")";
			
			// try executing the querry
			if ($conn->query($update) === FALSE) {
				// failed to update
			}
		}
	}
}

// check for no not track setting
function getDntStatus() {
   return (isset($_SERVER['HTTP_DNT']) && $_SERVER['HTTP_DNT'] == 1);
}

?>	