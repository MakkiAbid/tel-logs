<?php 


function notEmpty($data){
	if(isset($data) && !empty($data))
		return true;

	return false;
}


function clearInput($value)
{
	global $conn;
	$value = trim($value);
	$value = htmlspecialchars($value);
	$value = stripcslashes($value); 
	$value = mysqli_real_escape_string($conn, $value);
	return $value;
}