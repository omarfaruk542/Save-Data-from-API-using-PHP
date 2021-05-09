<?php
include_once __dir__.'/conn.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$userName = $_POST['username'];
	$email = $_POST['email'];
	$address = $_POST['address'];


	function arrMap($id,$name,$username,$email,$address){
		return ['id'=>$id,'name'=>$name,'username'=>$username,'email'=>$email,'address'=>$address];
	}

	$newArr = array_map('arrMap', $id,$name,$userName,$email,$address);

	$error = array();
	$message = "";
	foreach ($newArr as $key => $value) {
		$sql = "INSERT INTO tbluser(userId,name,username,email,address) 
		VALUES(".$value['id'].",'".$value['name']."','".$value['username']."','".$value['email']."','".$value['address']."')";
		$results = $conn->query($sql);	

		if(!$results){
			$error[] = array('sql'=>$sql,'msg'=>$conn->error);			

		} else {
			$message = 'success';
		}

	}

	if($message){
		echo $message;
	} else {
		echo json_encode($error);
	}	
}


?>