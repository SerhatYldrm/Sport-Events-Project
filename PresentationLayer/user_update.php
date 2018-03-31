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
		echo 'Baþarýlý bir þekilde.';
		header("location:admin.php");
	}
	else{
		echo 'Güncelleme iþlemi baþarýsýz';
	}
}
else{
	echo 'Yanlýþ yerlerde geziniyosun';
}

?>