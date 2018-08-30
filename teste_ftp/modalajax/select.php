<?php

//select.php

include('database_connection.php');

if(isset($_POST["id"])) {
	$query = "SELECT * FROM tbl_name WHERE id='".$_POST["id"]."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$programming_languages = '';
	$name = '';
	foreach($result as $row) {
		$name = $row["name"];
		$language_array = explode(",", $row["programming_languages"]);
		$count = 1;
		foreach($language_array as $language) {
			$button = '';
			if($count > 1) {
				$button = '<button type="button" name="remove" id="'.$count.'" class="btn btn-danger btn-xs remove">x</button>';
			} else {
				$button = '<button type="button" name="add_more" id="add_more" class="btn btn-success btn-xs">+</button>';
			}
			$programming_languages .= '
				<tr id="row'.$count.'">
					<td><input type="text" name="programming_languages[]" placeholder="Add Programming Languages" class="form-control name_list" value="'.$language.'" /></td>
					<td align="center">'.$button.'</td>
				</tr>
			';
			$count++;
		}
	}
	$output = array(
		'name'					=>	$name,
		'programming_languages'	=>	$programming_languages
	);
	echo json_encode($output);
}


?>