<?php 
	require_once("C:\\xampp\\htdocs\\Sport\\DataLayer\\DB.php");
	require_once("User.php");
	
	class UserManager {
		
		public static function getAllUsers () {
			$db = new DB();
			$result = $db->getDataTable("select userid, username, usersurname, maill, password from user order by userid");
			
			$allUsers = array();
			
			while($row = $result->fetch_assoc()) {
				$userObj = new User($row["userid"], $row["username"], $row["usersurname"], $row["maill"], $row["password"]);
				array_push($allUsers, $userObj);
			}
			
			return $allUsers;
		}
		
		public static function getOneUsers ($id) {
			$db = new DB();
			$result = $db->getDataTable("select userid, username, usersurname, maill, password from user where userid='$id'");
			
			$allUsers = array();
			
			while($row = $result->fetch_assoc()) {
				$userObj = new User($row["userid"], $row["username"], $row["usersurname"], $row["maill"], $row["password"]);
				array_push($allUsers, $userObj);
			}
			
			return $allUsers;
		}
		
		public static function insertNewUser($userName, $UserSurname, $Email, $Password) {
			$db = new DB();
			$success = $db->executeQuery("INSERT INTO user(username, usersurname, maill, password) VALUES ('$userName', '$UserSurname', '$Email', '$Password')");
			return $success;
		}
		public static function updateUser($id,$userName, $UserSurname, $Email, $Password) {
			$db = new DB();
			$success = $db->executeQuery("UPDATE user SET username='$userName', usersurname='$UserSurname', maill='$Email', password='$Password' where userid='$id'");
			return $success;
		}
		public static function deleteUser($id) {
			$db = new DB();
			$success = $db->executeQuery("DELETE From user where userid='$id'");
			return $success;
		}
		/*
		public static function LoginUser($Email, $Password) {
			$db = new DB();
			
			$success = $db->executeQuery("Select maill From user WHERE maill = '$Email' and password = '$Password'");
			if($row['maill'] == null)
			{
				$mesaj = "Bilgilerinizi kontrol edip tekrar deneyiniz";
				alert($mesaj);
			}
			else
			{
				session_start();
				$_SESSION['kullanici'] = $row['maill'];
				
				header("location: admin.php");
			}	
			return $success;
		}
		*/
	}
?>