<?php
ob_start();
require_once('core/init.php');
new Session();
ob_end_flush();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="success" >
      	<h3>
          <?php 
          	echo $_SESSION['success'];
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['loggedin'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['name']; ?></strong></p>
    	<p> <a href="index.php?logout=true" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>