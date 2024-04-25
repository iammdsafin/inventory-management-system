<?php

//category_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO category (category_name) 
		VALUES (?)
		";
		$statement = $connect->prepare($query);
		$statement->bind_param("s", $_POST["category_name"]);
		$statement->execute();
		$result = $statement->get_result();
		if(isset($result))
		{
			echo 'Category Name Added';
		}
	}
	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM category WHERE category_id = :category_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':category_id'	=>	$_POST["category_id"]
			)
		);
		$result = $statement->get_result();
		foreach($result as $row)
		{
			$output['category_name'] = $row['category_name'];
		}
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE category set category_name = :category_name  
		WHERE category_id = :category_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':category_name'	=>	$_POST["category_name"],
				':category_id'		=>	$_POST["category_id"]
			)
		);
		$result = $statement->get_result();
		if(isset($result))
		{
			echo 'Category Name Edited';
		}
	}

	if($_POST['btn_action'] == 'delete')
	{
		$status = 'active';
		if($_POST['status'] == 'active')
		{
			$status = 'inactive';    
		}
		$query = "
		UPDATE category 
		SET category_status = ? 
		WHERE category_id = ?
		";
		$statement = $connect->prepare($query);
		$statement->bind_param("si", $status, $_POST["category_id"]);
		$statement->execute();
		$result = $statement->get_result();
		if(isset($result))
		{
			echo 'Category status change to ' . $status;
		}
	}
}