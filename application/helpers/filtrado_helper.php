<?php

function valid_dni($dni)
{
	$dni = trim($dni);  
	$dni = str_replace("-","",$dni);  
	$dni = str_ireplace(" ","",$dni);

	if ( !preg_match("/^[0-9]{7,8}[a-zA-Z]{1}$/" , $dni) )
	{
		return FALSE;
	}
	else
	{
		$n = substr($dni, 0 , -1);      
		$letra_dni = substr($dni,-1);
		$letra_correcta = substr ("TRWAGMYFPDXBNJZSQVHLCKE", $n%23, 1); 
		if(strtolower($letra_dni) != strtolower($letra_correcta))
			return FALSE;
	}
	return TRUE;
}




