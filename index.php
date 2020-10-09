<?php 
	// Message Vars
	$msg = '';
	$msgClass = '';

	// Check For Submit
	if(filter_has_var(INPUT_POST, 'submit')) {
		// Get Form Data
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$message = htmlspecialchars($_POST['message']);

		// Check Required Fields
		if(!empty($email) && !empty($name) && !empty($message)) {
			// Passed
			// Check Email
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$msg = 'PLEASE USE VALID EMAIL';
			$msgClass='alert alert-dismissible alert-primary text-center';
			} else {
				// Passed
				$toEmail = 'techtofer@gmail.com';
				$subject = 'Contact Request From ' .$name;
				$body = "<h2>Contact Request</h2>
					<h4>Name</h4><p>$name</p>
					<h4>Email</h4><p>$email</p>
					<h4>Message</h4><p>$message</p>
				";

				// Email Headers 

				$headers = "MIME-Version: 1.0" ."\r\n";
				$headers .= "Content-Type:text/html;charset=UTF-8" ."\r\n";

				// Additional Headers
				$headers .= "From: " .$name. "<".$email.">". "\r\n";

				if(mail($toEmail, $subject, $body, $headers)) {
					$msg = 'Your email has been sent';
					$msgClass='alert-success text-center';
				} else {
					$msg = 'Your Email was not sent';
					$msgClass='alert alert-dismissible alert-danger text-center';
				}

			  }
		}else {
			// Failed
			$msg = 'PLEASE FILL IN ALL FIELDS';
			$msgClass='alert alert-dismissible alert-danger text-center';
		}

	};


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>CONTACT US</title>	
	<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">    
          <a class="navbar-brand" href="index.php">My Website</a>
        </div>
      </div>
    </nav>

    <div class="container">
    	<?php if($msg != ''): ?>
    		<div class="<?php echo $msgClass; ?> "><?php echo $msg; ?></div>
    	<?php endif; ?>
    	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    		<div class="form-group">
    			<label>Name</label>
    			<input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
    		</div>
    		<div class="form-group">
    			<label>Email</label>
    			<input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
    		</div>
    		<div class="form-group">
    			<label>Message</label>
    			<textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
    		</div>
    		<br>
    		<button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
    	</form>
    </div>
</body>
</html>