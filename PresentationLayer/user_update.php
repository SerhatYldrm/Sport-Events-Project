<?php

	require_once("C:\\xampp\\htdocs\\Sport\\LogicLayer\\UserManager.php");


if ($_POST){
    $id=$_POST["id"];
	$ad=$_POST["ad"];
	$soyad=$_POST["soyad"];
	$e_posta=$_POST["e_posta"];
	$password=$_POST["password"];
	
	
	$kayitt = UserManager::updateUser($id,$ad,$soyad,$e_posta,$password);
	
	if ($kayitt){
		echo 'Ba�ar�l� bir �ekilde.';
		header("location:admin.php");
	}
	else{
		echo 'G�ncelleme i�lemi ba�ar�s�z';
	}
}
else{
	echo 'Yanl�� yerlerde geziniyosun';
}

?>