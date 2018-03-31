<?php 

	require_once("C:\\xampp\\htdocs\\Sport\\LogicLayer\\UserManager.php");
	
	$errorMeesage = "";
	
	
	
	
if ($_POST)
{
	if(isset($_POST["username"]) && isset($_POST["usersurname"])&& isset($_POST["email"])&& isset($_POST["password"])) {	//insert 
		$name = trim($_POST["username"]);
		$surname = trim($_POST["usersurname"]);
		$email = trim($_POST["email"]);
		$password = trim($_POST["password"]);
		
		$errorMeesage = "";
		$result = UserManager::insertNewUser($name, $surname, $email, $password);
		if(!$result) {
			$errorMeesage = "Yeni kullanıcı kaydı başarısız!";
		}		
		else{
			header("location:admin.php");
		}
	}

	if (isset($_POST["gonder"])){		//"Güncelle" ye tıklandıysa
	
	
		if(isset($_POST["id"]))
			$id=$_POST["id"];//Hidden elementinden gelen id bilgisi
		
		$kayit = UserManager::getOneUsers($id);
		
		
			echo	'<form name="form1" method="post" action="http://localhost:8080/Sport/presentationlayer/user_update.php">';
				echo	'<input type="text" name="ad" value="'.$kayit[0]->getUserName().'"/><br/>';
				echo	'	<input type="text" name="soyad" value="'.$kayit[0]->getUsersurname().'"/><br/>';
				echo	'<input type="text" name="e_posta" value="'.$kayit[0]->getEmail().'"/><br/>';
				echo	'<input type="text" name="password" value="'.$kayit[0]->getPassword().'"/><br/>';
				echo	'<input type="hidden" name="id" value="'.$kayit[0]->getID().'"/>';
				echo	'<input type="submit" name="gonder" value="Güncelle"/>';
			echo	'</form>';
		
				
	}
	
	if (isset($_POST["delete"])){		//"Silme" ye tıklandıysa
	
		if(isset($_POST["id"]))
			$id=$_POST["id"];//Hidden elementinden gelen id bilgisi
				
		$result = UserManager::deleteUser($id);
	
		if(!$result) {
			$errorMeesage = "Kullanıcı silme başarısız!";
		}	
		
		else{
			header("location:admin.php");
		}
		
	}
	
		
	
	}
	else{							// Kayıtları Listeleme
						?>

<!DOCTYPE html>

<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Admin Page</title>
		<meta name="description" content="Sticky Table Headers Revisited: Creating functional and flexible sticky table headers" />
		<meta name="keywords" content="Sticky Table Headers Revisited" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<!--[if IE]>
  		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>			
			<div class="component">				
				<table>
				<h2>Users</h2>
					<thead>
						<tr>
							<th>Userid</th>
							<th>Username</th>
							<th>Usersurname</th>
							<th>Email</th>
							<th>Password</th>
						</tr>		
					</thead>
					<tbody>
					
						<?php 
							$userList = UserManager::getAllUsers();
						
							for($i = 0; $i < count($userList); $i++) {
							?>
								<tr>
								<form method="POST" action="<?php $_PHP_SELF ?>">
										<td><?php echo $userList[$i]->getID(); ?></td>
										<td><?php echo $userList[$i]->getUserName(); ?></td>
										<td><?php echo $userList[$i]->getUsersurname(); ?></td>
										<td><?php echo $userList[$i]->getEmail(); ?></td>
										<td><?php echo $userList[$i]->getPassword(); ?></td>
										
										<td><input type="submit" name="gonder" value="Update"/></td>
										<td><input type="submit" name="delete" value="Delete"/></td>
										
										
										 <?php
										 echo '<input type="hidden" name="id" value="'.$userList[$i]->getID().'"/>';
										 ?>
								</form>
								</tr>
							<?php
							}
						?>
					
						<form method="POST" action="<?php $_PHP_SELF ?>">
						<tr>
							<td></td>
							<td>
								<input type="text" name="username" required />
							</td>
							<td>
								<input type="text" name="usersurname" required />
							</td>
							<td>
								<input type="text" name="email" required />
							</td>
							<td>
								<input type="number" name="password" required />
							</td>
							<td>
								<input type="submit" name="save" value="Insert " />							
								<?php 
									if(isset($errorMeesage)) {
										echo "<br>" . "<span style='color: red;'>" . $errorMeesage . "</span>";
									}
								?>
							</td>
						</tr>
						</form>
					</tbody>
				</table>
				
				
			</div>		
		</div><!-- /container -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
		<script src="js/jquery.stickyheader.js"></script>
	</body>
</html>

<?php } ?>