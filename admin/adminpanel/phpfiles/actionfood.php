<?php

	$connect = mysqli_connect('localhost','root','','canteen');
	
	$input = filter_input_array(INPUT_POST);
	
	$foodname=mysqli_real_escape_string($connect,$input["name"]);
	$price=mysqli_real_escape_string($connect,$input['price']);	

	
	if($input['action'] === 'edit')
	{
		$query= "
		UPDATE food
		SET name= '".$foodname."',
		price= '".$price."'
		WHERE foodid='".$input['foodid']."'
		";
		
		mysqli_query($connect,$query);
		
	}
	if($input['action']==='delete')
	{
		$query="
		DELETE FROM food
		WHERE foodid='".$input['foodid']."'
		";
		mysqli_query($connect,$query);
	}
	
	echo json_encode($input);
?>