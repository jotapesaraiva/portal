<?php

//action.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	$programming_languages = implode(",", $_POST["programming_languages"]);
	$data = array(
		':name'						=>	$_POST["name"],
		':programming_languages'	=>	$programming_languages
	);
	$query = '';
	if($_POST["action"] == "insert")
	{
		$query = "INSERT INTO tbl_name (name, programming_languages) VALUES (:name, :programming_languages)";
	}
	if($_POST["action"] == "edit")
	{
		$query = "
		UPDATE tbl_name 
		SET name = :name, 
		programming_languages = :programming_languages 
		WHERE id = '".$_POST['hidden_id']."'
		";
	}

	$statement = $connect->prepare($query);
	$statement->execute($data);
}


?>