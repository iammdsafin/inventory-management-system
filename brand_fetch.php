<?php
//brand_fetch.php

include('database_connection.php');

$query = '';
$output = array();
$query .= "SELECT * FROM brand INNER JOIN category ON category.category_id = brand.category_id ";

if (isset($_POST["search"]["value"])) {
	$search_value = $_POST["search"]["value"];
	$query .= 'WHERE brand.brand_name LIKE ? ';
	$query .= 'OR category.category_name LIKE ? ';
	$query .= 'OR brand.brand_status LIKE ? ';
}

if (isset($_POST["order"])) {
	$order_column = $_POST['order']['0']['column'];
	$order_direction = $_POST['order']['0']['dir'];
	$query .= 'ORDER BY ' . intval($order_column) . ' ' . ($order_direction === 'asc' ? 'ASC' : 'DESC') . ' ';
} else {
	$query .= 'ORDER BY brand.brand_id DESC ';
}

if ($_POST["length"] != -1) {
	$start = $_POST['start'];
	$length = $_POST['length'];
	$query .= 'LIMIT ?, ?';
}

$statement = $connect->prepare($query);

if (isset($_POST["search"]["value"])) {
	$search_param = "%{$search_value}%";
	$statement->bind_param("sssii", $search_param, $search_param, $search_param, $start, $length);
} else if ($_POST["length"] != -1) {
	$statement->bind_param("ii", $start, $length);
}

$statement->execute();
$result = $statement->get_result();
$data = array();
$filtered_rows = mysqli_num_rows($result);

foreach ($result as $row) {
	$status = '';
	if ($row['brand_status'] == 'active') {
		$status = '<span class="label label-success">Active</span>';
	} else {
		$status = '<span class="label label-danger">Inactive</span>';
	}
	$sub_array = array();
	$sub_array[] = $row['brand_id'];
	$sub_array[] = $row['category_name'];
	$sub_array[] = $row['brand_name'];
	$sub_array[] = $status;
	$sub_array[] = '<button type="button" name="update" id="' . $row["brand_id"] . '" class="btn btn-warning btn-xs update">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="' . $row["brand_id"] . '" class="btn btn-danger btn-xs delete" data-status="' . $row["brand_status"] . '">Delete</button>';
	$data[] = $sub_array;
}

$output = array(
	"draw"              =>  intval($_POST["draw"]),
	"recordsTotal"      =>  $filtered_rows,
	"recordsFiltered"   =>  get_total_all_records($connect),
	"data"              =>  $data
);
echo json_encode($output);

function get_total_all_records($connect)
{
	$statement = $connect->prepare("SELECT * FROM brand");
	$statement->execute();
	$result = $statement->get_result();
	return mysqli_num_rows($result);
}