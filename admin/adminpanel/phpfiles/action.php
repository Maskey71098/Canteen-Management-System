<?php

	$connect = mysqli_connect('localhost','root','','canteen');
	
	$input = filter_input_array(INPUT_POST);
	
	$username=mysqli_real_escape_string($connect,$input["username"]);
	$password=mysqli_real_escape_string($connect,$input['password']);	
	$email=mysqli_real_escape_string($connect,$input['email']);
	$phone=mysqli_real_escape_string($connect,$input['phone']);
	
	if($input['action'] === 'edit')
	{
		$query= "
		UPDATE login
		SET username= '".$username."',
		password= '".$password."',
		email= '".$email."',
		phone= '".$phone."'
		WHERE user_id='".$input['user_id']."'
		";
		
		mysqli_query($connect,$query);
		
	}
	if($input['action']==='delete')
	{
		$query="
		DELETE FROM login
		WHERE user_id='".$input['user_id']."'
		";
		mysqli_query($connect,$query);
	}
	
	echo json_encode($input);
?>