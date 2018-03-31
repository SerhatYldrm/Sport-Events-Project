<?php 
	class User {
		private $userid;
		private $username;
		private $usersurname;
		private $email;
		private $password;
		
		function __construct($userid = NULL, $username = NULL, $usersurname = NULL, $email = NULL, $password = NULL) {
			$this->userid = $userid;
			$this->username = $username;
			$this->usersurname = $usersurname;
			$this->email = $email;
			$this->password = $password;
		}
		
		public function getID() {
			return $this->userid;
		}
		
		public function getUserName() {
			return $this->username;
		}
		
		public function getUserSurname() {
			return $this->usersurname;	
		}
		
		public function getEmail() {
			return $this->email;	
		}
		
		public function getPassword() {
			return $this->password;	
		}
	}
?>