<?php
ob_start();
require_once('core/init.php');
new Session();
ob_end_flush();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>User profile</title>
		<link rel="stylesheet" href="View/css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;700&display=swap" rel="stylesheet">
		<link rel="shortcut icon" type="image/png" href="View/img/logo.jpg"/>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row justify-content-center greetingsPanel">
				<div class="col-lg-3">					
					<!-- logged in user information -->
					<?php  if (isset($_SESSION['loggedin'])) : ?>
						<h5>Welcome <strong><?php echo $_SESSION['name']; ?></strong></h5>
					<?php endif ?>
				</div>
				<div class="col-lg-2 offset-lg-2">
					<h2 id="profileHeader">User Profile</h2>
				</div>
				<div class="col-lg-1 offset-lg-4">
					<h5 ><strong><a href="index.php?logout=true" id="logout">Logout</a> </strong></h5>
				</div>
			</div>	
			<div class="row justify-content-center">
				<div class="jumbotron attributes">
					<?php $userAttributes = new Attributes();
						$userAttributes->requestAttributes($_SESSION['email']);
					?>
				</div>
			</div>			
		</div>
		<footer class="page-footer">
        <div class="container">
            <p class="copyrights">
                ALL RIGHTS RESERVED "MEGABIT" 2016.
            </p>
        </div>
    </footer>				
	</body>
</html>