<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Cafeteria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body >
	<div class="container justify-content-center">
		<h1><a>Edit Users</a></h1>
		<form method="post" action="../update.php" enctype="multipart/form-data">	
			<ul >
				<li class="form-group">
					<label>Username </label>
					<div>
						<input name="username" class="form-control" type="text" maxlength="255" value="<?php echo $_GET['username'];?>" readonly/> 
					</div> 
				</li>		
				<li class="form-group" >
					<label >Email </label>
					<div>
						<input name="email" class="form-control " type="text" maxlength="255" value="<?php echo $_GET['email'];?>"/>
					</div> 
				</li>
				<li class="form-group">
					<label>Room No. </label>
					<div>
						<input name="room" class="form-control" type="text" maxlength="255" value="<?php echo $_GET['room'];?>"/>
					</div> 
				</li>
				<li class="form-group">
					<label>Ext </label>
					<div>
						<input name="ext" class="form-control" type="text" maxlength="255" value="<?php echo $_GET['ext'];?>"/> 
					</div> 
				</li>
				<li class="form-group">
					<label>Profile Picture </label>
					<div>
						<input name="image" type="file" maxlength="255" value="" required/> 
					</div> 
				</li>
				<li class="form-group">
					<label>Role </label>
					<div>
						<select class="element select medium" name="role"> 
							<option value="0" <?php if($_GET['role']==0){echo 'selected="selected"';}?> >Customer</option>
							<option value="1" <?php if($_GET['role']==1){echo 'selected="selected"';}?> >Admin</option>
						</select>
					</div> 
				</li>
				<li class="errors" style='display:none'>
			    	<ul id='error-messages'>
			    	</ul>
				</li>
				<br>
				<div>
				<input class="btn btn-success" type="submit" name="submit" value="Submit" />
				<a class="btn btn-danger" href="../allUsers.php"> Cancel </a>
			</div>
		</ul>
	</form>
		</script>
	</body>
</html>